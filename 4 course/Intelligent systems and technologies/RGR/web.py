import pandas as pd #обработка (загрузка, сохранение, анализа) данных
from sklearn import linear_model
import tensorflow as tf
import json
import pickle
import streamlit as st

target=['charges']
features=['age','bmi','children','sex_female','sex_male','smoker_no','smoker_yes','reg_northeast','reg_northwest','reg_southeast','reg_southwest']

#sidebar
st.title('RGR')
st.sidebar.header("Параметры")

age=st.sidebar.number_input('Возраст')
bmi=st.sidebar.number_input('Масса тела')
children=st.sidebar.slider('Количестов детей',0,30,1)

sex=st.sidebar.radio('Пол',('М','Ж'))
smoker=st.sidebar.checkbox('Курение')
region=st.sidebar.selectbox('Регион',('Северо-Восток','Северо-Запад','Юго-Восток','Юго-Запад'))

with open('C:\\Users\\Niksolo\\siiimo\\RGR\\scalerNorm_X.pickle', 'rb') as handle:
    scalerNorm_X=pickle.load(handle)
with open('C:\\Users\\Niksolo\\siiimo\RGR\\scalerNorm_Y.pickle', 'rb') as handle:
    scalerNorm_Y=pickle.load(handle)

with open(r'C:\\Users\Niksolo\\siiimo\\RGR\\linear_model_saved.pickle', 'rb') as handle:
    linear_model =pickle.load(handle)

neuro_model= tf.keras.models.load_model(r"C:\\Users\\Niksolo\\siiimo\RGR\\neuro_model_saved.h5")

if sex == 'М':
    sex_male=1
    sex_female=0
else:
    sex_female=1
    sex_male=0

if smoker==True:
    smoker_no=0
    smoker_yes=1
else:
    smoker_no=1
    smoker_yes=0

if region=='Северо-Восток':
    reg_northeast=1
    reg_northwest=0
    reg_southeast=0
    reg_southwest=0
if region=='Северо-Запад':
    reg_northeast=0
    reg_northwest=1
    reg_southeast=0
    reg_southwest=0
if region=='Юго-Восток':
    reg_northeast=0
    reg_northwest=0
    reg_southeast=1
    reg_southwest=0
if region=='Юго-Запад':
    reg_northeast=0
    reg_northwest=0
    reg_southeast=0
    reg_southwest=1

features=['age','bmi','children','sex_female','sex_male','smoker_no','smoker_yes','reg_northeast','reg_northwest','reg_southeast','reg_southwest']
DataFrame_Custom=pd.DataFrame(data=[[age,	bmi,	children,	sex_female,	sex_male,	smoker_no,	smoker_yes,	reg_northeast,	reg_northwest,	reg_southeast,	reg_southwest]],
 columns=[features])
DataFrame_Valid=pd.DataFrame(data=[[21.0,	27.9,	0.0,	1,	0,	1,	0,	0,	0,	1,	0]], columns=[features])

DataFrame_Custom_Norm = pd.DataFrame (
  data    = scalerNorm_X.transform(DataFrame_Custom), 
  columns = DataFrame_Custom.columns,           
  index   = DataFrame_Custom.index              
)

with open('C:\\Users\\Niksolo\\siiimo\\RGR\\data_char_m1.json', 'r', encoding='utf-8') as f:
    m1_dict= json.load(f)
with open('C:\\Users\\Niksolo\\siiimo\\RGR\\data_char_m2.json', 'r', encoding='utf-8') as f:
    m2_dict= json.load(f)

y_pred_lin=linear_model.predict(DataFrame_Custom)

st.subheader("Ваши Данные")
st.table(DataFrame_Custom)
st.subheader("Ваши Данные")
st.table(DataFrame_Custom_Norm)
st.subheader("Значения для проверки")
st.table(DataFrame_Valid)

col1, col2, col3 = st.columns(3,gap='large')
with col1:
    st.subheader('Тип модели: Линейная регрессия')
    st.write('MAE:', str(m1_dict['MAE']))
    st.write('MSE:', str(m1_dict['MSE']))
    st.write('RMSE:', str(m1_dict['RMSE']))
    st.write('R2:', str(m1_dict['R2']))
    st.write('Полученное значение:',y_pred_lin)
    st.write('Оригинальное значение:',m1_dict['y_test'])

with tf.device('/CPU:0'):
    y_neuro_pred_norm = neuro_model.predict( DataFrame_Custom_Norm)
st.write(y_neuro_pred_norm)
y_neuro_pred = scalerNorm_Y.inverse_transform(y_neuro_pred_norm)

with col2:
    st.subheader('Тип модели: Нейронная сеть')
    st.write('MAE:', str(m2_dict['MAE']))
    st.write('MSE:', str(m2_dict['MSE']))
    st.write('RMSE:', str(m2_dict['RMSE']))
    st.write('R2:', str(m2_dict['R2']))
    st.write('Полученное значение:',y_neuro_pred[0])
    st.write('Оригинальное значение:',m2_dict['y_test'])

DataResults = pd.DataFrame(
    [
        ['m1', str(y_pred_lin[0]), str(m1_dict['y_test']), str(m1_dict['R2']), str(m1_dict['RMSE']), str(m1_dict['MSE']), str(m1_dict['MAE'])],
        ["m2", str(y_neuro_pred[0]), str(m2_dict['y_test']), str(m2_dict['R2']), str(m2_dict['RMSE']), str(m2_dict['MSE']), str(m2_dict['MAE'])],
    ],
    columns= ["id", "Вычесленное", "Проверочное", "R2", "RMSE", "MSE", "MAE" ],
)
st.table(DataResults)
