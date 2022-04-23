import pandas as pd

df = pd.read_excel("the_only_excel.xlsx")

print(df['NGG'])
print(df['NGG'].dtype)