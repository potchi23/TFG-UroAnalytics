import pandas as pd
from sklearn.preprocessing import LabelEncoder
from sklearn.ensemble import RandomForestClassifier, VotingClassifier
from sklearn.model_selection import train_test_split
from sklearn.neighbors import KNeighborsClassifier
from sklearn.preprocessing import MinMaxScaler
from sklearn.preprocessing import StandardScaler
from sklearn.pipeline import Pipeline
from sklearn.linear_model import LogisticRegression
from sklearn.metrics import recall_score
from sklearn.metrics import precision_score
from sklearn.metrics import accuracy_score
from sklearn.metrics import f1_score

def drop_columns(df):
    df = df.drop('FECHACIR', axis=1)
    df = df.drop('FECHAFIN', axis=1)
    df = df.drop('ETNIA', axis=1)
    df = df.drop('HISTO2', axis=1)
    df = df.drop('NOTAS', axis=1)

    df = df.drop('IMC', axis=1)
    df = df.drop('ASA', axis=1)
    df = df.drop('GR', axis=1)
    df = df.drop('PNV', axis=1)
    df = df.drop('TQ', axis=1)
    df = df.drop('TH', axis=1)
    df = df.drop('NGG', axis=1)
    df = df.drop('PGG', axis=1)

    #df = df.drop('TDUPLI.r1', axis=1)
    #df = df.drop('t.seg', axis=1)
    #df = df.drop('RA-estroma', axis=1)

    return df

def df_categorical_to_encoded(df):
    for column in df:
        if df[column].dtypes == object:
            label_encoder = LabelEncoder()
            categorical_Encoded = label_encoder.fit_transform(df[column])
            df[column] = categorical_Encoded

    return df

def na_to_median(df):
    for column in df:
        if(df[column].isnull().values.any()):
            median = df[column].median()
            df[column].fillna(median, inplace=True)
    
    return df

def randomForestTraining(X_train, X_test, y_train, y_test):
    pipe_rfc = Pipeline([
                    ('scl', StandardScaler()),
                    ('norm', MinMaxScaler()),
                    ('rfc', RandomForestClassifier(n_estimators=100, bootstrap=False, max_features='sqrt'))    
                    ])
    pipe_rfc.fit(X_train, y_train)
    accuracy = pipe_rfc.score(X_test, y_test)

    y_predict = pipe_rfc.predict(X_test)
    recall = recall_score(y_test, y_predict, average=None)
    precision = precision_score(y_test, y_predict, average=None)

    scores = {
            'accuracy':accuracy,
            'recall':list(recall),
            'precision':list(precision)
        }

    return pipe_rfc, scores

def logisticRegresionTraining(X_train, X_test, y_train, y_test):
    pipe_lrc = Pipeline([
                    ('scl', StandardScaler()),
                    ('norm', MinMaxScaler()),
                    ('lrc', LogisticRegression(C=1.0, penalty='l2'))    
                    ])
    pipe_lrc.fit(X_train, y_train)
    accuracy = pipe_lrc.score(X_test, y_test)
    
    y_predict = pipe_lrc.predict(X_test)
    recall = recall_score(y_test, y_predict, average=None)
    precision = precision_score(y_test, y_predict, average=None)

    scores = {
            'accuracy':accuracy,
            'recall':list(recall),
            'precision':list(precision)
        }

    return pipe_lrc, scores
    
def knnTraining(X_train, X_test, y_train, y_test):
    pipe_knn = Pipeline([
                     ('scl', StandardScaler()),
                     ('norm', MinMaxScaler()),
                     ('knn', KNeighborsClassifier(8))    
                    ])
    pipe_knn.fit(X_train, y_train)
    accuracy = pipe_knn.score(X_test, y_test)

    y_predict = pipe_knn.predict(X_test)
    recall = recall_score(y_test, y_predict, average=None)
    precision = precision_score(y_test, y_predict, average=None)

    scores = {
            'accuracy':accuracy,
            'recall':list(recall),
            'precision':list(precision)
        }

    return pipe_knn, scores

def bestTraining(X_train, X_test, y_train, y_test, estimators):
    #estimators = [('prfc', pipe_rfc),('pknn', pipe_knn), ('plrc', pipe_clr)]
    pipe_best = VotingClassifier(
                    estimators=estimators,
                    voting='soft'
                )
    pipe_best.fit(X_train, y_train)
    accuracy = pipe_best.score(X_test, y_test)

    y_predict = pipe_best.predict(X_test)
    recall = recall_score(y_test, y_predict, average=None)
    precision = precision_score(y_test, y_predict, average=None)

    scores = {
            'accuracy':accuracy,
            'recall':list(recall),
            'precision':list(precision)
        }

    return pipe_best, scores

# Punto de entrada
def trainModels(df):
    print('Starting training...')

    #df = pd.read_csv('data.csv', sep=';', encoding='cp1252',decimal=",")
    df = drop_columns(df)
    df = df_categorical_to_encoded(df)
    df = na_to_median(df)

    df.info()

    y = df['RBQ'] 
    X = df.drop('RBQ', axis=1)
    X_train, X_test, y_train, y_test = train_test_split(X, y, train_size=0.7)

    pipe_rfc, scores_rfc = randomForestTraining(X_train, X_test, y_train, y_test)
    pipe_lrc, scores_lrc = logisticRegresionTraining(X_train, X_test, y_train, y_test)
    pipe_knn, scores_knn = knnTraining(X_train, X_test, y_train, y_test)
    pipe_best, scores_best = bestTraining(X_train, X_test, y_train, y_test, [('prfc', pipe_rfc),('pknn', pipe_knn), ('plrc', pipe_lrc)])

    scores = {
        'rfc' : scores_rfc,
        'lrc' : scores_lrc,
        'knn' : scores_knn,
        'best' : scores_best
    }

    return pipe_rfc, pipe_lrc, pipe_knn, pipe_best, scores


    
