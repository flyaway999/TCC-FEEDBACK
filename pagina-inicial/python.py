import mysql.connector

# Conectando ao banco de dados
conn = mysql.connector.connect(
    host="localhost",
    user="root",        # seu usuário
    password="sua_senha",  # sua senha
    database="ecommerce"   # nome do banco
)

cursor = conn.cursor()

# Criando tabela com SQL
cursor.execute("""
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100)
)
""")

# Inserindo dados com SQL
cursor.execute("INSERT INTO users (name, email) VALUES (%s, %s)", ("Gustavo", "gustavo@email.com"))

# Commitar e fechar
conn.commit()
cursor.close()
conn.close()
