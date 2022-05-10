from random import randrange
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

train_size = 0.6

def drop_columns(df):
    df = df.drop(['N', 'NOTAS', 'FECHACIR', 'FECHAFIN','ETNIA', 'IPERIN', 'ILINF', 'IVASCU', 'ILINF2', 'IVASCU2', 'FALLEC'], axis=1)
    return df

def replace_IPERIN2_NC(df):
    for row in df[df["IPERIN2"] == 3].index:
        df.at[row, "IPERIN2"] = randrange(1,3)
    
    return df

def replace_RBQ_persistencia(df):
    for row in df[df["RBQ"] == 3].index:
        df.at[row, "RBQ"] = randrange(1,3)

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

def randomForestTraining(X, y):
    X_train, X_test, y_train, y_test = train_test_split(X, y, train_size=train_size)

    rfc = RandomForestClassifier(n_estimators=100, bootstrap=True, max_samples=100, class_weight='balanced')
    rfc.fit(X_train, y_train)
    accuracy = rfc.score(X_test, y_test)

    y_predict = rfc.predict(X_test)
    recall = recall_score(y_test, y_predict, average=None, zero_division=0)
    precision = precision_score(y_test, y_predict, average=None, zero_division=0)

    scores = {
            'accuracy':accuracy,
            'recall':list(recall),
            'precision':list(precision)
        }

    print('random forest score: ' + str(scores))

    return rfc, scores

def logisticRegresionTraining(X, y):
    X_train, X_test, y_train, y_test = train_test_split(X, y, train_size=train_size)

    lrc = LogisticRegression(C=0.5, penalty='l2', solver='liblinear', class_weight='balanced')

    lrc.fit(X_train, y_train)
    accuracy = lrc.score(X_test, y_test)
    
    y_predict = lrc.predict(X_test)
    recall = recall_score(y_test, y_predict, average=None, zero_division=0)
    precision = precision_score(y_test, y_predict, average=None, zero_division=0)
    scores = {
            'accuracy':accuracy,
            'recall':list(recall),
            'precision':list(precision)
        }

    print('logistic regression score: ' + str(scores))

    return lrc, scores
    
def knnTraining(X, y):
    X_train, X_test, y_train, y_test = train_test_split(X, y, train_size=train_size)

    pipe_knn = Pipeline([
                     ('norm', MinMaxScaler()),
                     ('knn', KNeighborsClassifier(n_neighbors=4, p=2))     
                    ])
    pipe_knn.fit(X_train, y_train)
    accuracy = pipe_knn.score(X_test, y_test)

    y_predict = pipe_knn.predict(X_test)
    recall = recall_score(y_test, y_predict, average=None, zero_division=0)
    precision = precision_score(y_test, y_predict, average=None, zero_division=0)

    scores = {
            'accuracy':accuracy,
            'recall':list(recall),
            'precision':list(precision)
        }

    print('knn score: ' + str(scores))

    return pipe_knn, scores

def votingTraining(X, y, estimators):
    X_train, X_test, y_train, y_test = train_test_split(X, y, train_size=train_size)

    # estimators = [('prfc', pipe_rfc),('pknn', pipe_knn), ('plrc', pipe_clr)]
    pipe_best = VotingClassifier(
                    estimators=estimators,
                    voting='hard'
                )
    pipe_best.fit(X_train, y_train)
    accuracy = pipe_best.score(X_test, y_test)

    y_predict = pipe_best.predict(X_test)
    recall = recall_score(y_test, y_predict, average=None, zero_division=0)
    precision = precision_score(y_test, y_predict, average=None, zero_division=0)

    scores = {
            'accuracy':accuracy,
            'recall':list(recall),
            'precision':list(precision)
        }

    print('best train score: ' + str(scores))

    return pipe_best, scores

# Punto de entrada
def trainModels(df):
    print('Starting training...')

    df = drop_columns(df)
    df = df_categorical_to_encoded(df)
    df = na_to_median(df)
    df = replace_RBQ_persistencia(df)
    df = replace_IPERIN2_NC(df)

    df.info()

    y = df['RBQ'] 
    X = df.drop('RBQ', axis=1)

    pipe_rfc, scores_rfc = randomForestTraining(X, y)
    pipe_lrc, scores_lrc = logisticRegresionTraining(X, y)
    pipe_knn, scores_knn = knnTraining(X, y)
    pipe_best, scores_best = votingTraining(X, y, [('prfc', pipe_rfc),('pknn', pipe_knn), ('plrc', pipe_lrc)])

    scores = {
        'rfc' : scores_rfc,
        'lrc' : scores_lrc,
        'knn' : scores_knn,
        'best' : scores_best
    }

    return pipe_rfc, pipe_lrc, pipe_knn, pipe_best, scores


    
