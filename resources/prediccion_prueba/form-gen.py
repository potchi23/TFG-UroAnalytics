import pandas as pd

csv = pd.read_csv('estadistica-final.csv', sep=';', encoding='cp1252',decimal=",")

for col in csv.columns:
    html = """
    <div class="input-group-prepend">
        <span class="input-group-text">{variable}</span>
        <input type="text" id="{variable}" name="{variable}" placeholder="{variable}" value="{{$_SESSION["dataInputs"]['{variable}']}}">
    </div>""".format(variable = col)

    f = open("output.html", "a")
    f.write(html)
    print(html)

f.close()