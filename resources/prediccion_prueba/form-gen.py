import pandas as pd

csv = pd.read_csv('singledata.csv', sep=';', encoding='cp1252',decimal=",")

i = 0
for col in csv.columns:
    
    html = """
    <div class="input-group-prepend">
        <span class="input-group-text">{variable}</span>
        <input class="prediction-form-input" type="text" id="{variable}" name="{variable}" placeholder="{variable}" value="">
    </div>""".format(variable = col)


    f = open("output.html","a")
    f.write(html)
    print(html)

    i+=1

f.close()
