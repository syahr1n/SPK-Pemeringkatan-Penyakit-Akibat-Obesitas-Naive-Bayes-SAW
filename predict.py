import pandas as pd
import mysql.connector
import joblib
from datetime import datetime

# Koneksi ke database
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="riskobesity"
)

# Load model Naive Bayes yang sudah kamu training sebelumnya
model = joblib.load("model_naive_bayes.pkl")

# Ambil data BMI yang belum diprediksi
query = """
SELECT id, age, gender, height, weight, bmi 
FROM data_bmi 
WHERE id NOT IN (SELECT id_bmi FROM hasil_prediksi)
"""
data = pd.read_sql(query, db)

# Kalau tidak ada data baru
if data.empty:
    print("Tidak ada data baru untuk diprediksi.")
else:
    # Encode gender ke numerik (Male=1, Female=0)
    data['gender'] = data['gender'].map({'Male': 1, 'Female': 0})

    # Ambil fitur yang dibutuhkan
    X_new = data[['age', 'gender', 'height', 'weight', 'bmi']]

    # Prediksi kategori
    prediksi = model.predict(X_new)

    # Simpan hasil prediksi ke database
    cursor = db.cursor()
    for i, kategori in enumerate(prediksi):
        id_bmi = int(data.loc[i, 'id'])
        waktu_prediksi = datetime.now().strftime('%Y-%m-%d %H:%M:%S')
        
        query_insert = """
            INSERT INTO hasil_prediksi (id_bmi, prediksi_kategori, waktu_prediksi)
            VALUES (%s, %s, %s)
        """
        # Convert kategori ke native Python str biar aman di MySQL
        cursor.execute(query_insert, (id_bmi, str(kategori), waktu_prediksi))

    db.commit()
    print(f"{len(prediksi)} data berhasil diprediksi dan disimpan.")
