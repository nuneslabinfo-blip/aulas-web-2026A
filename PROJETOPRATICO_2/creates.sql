CREATE TABLE categorias (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE tarefas (
    id SERIAL PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    data_prazo DATE,
    status BOOLEAN DEFAULT FALSE,
    categoria_id INTEGER REFERENCES categorias(id)
);

-- Inserir algumas categorias iniciais para teste
INSERT INTO categorias (nome) VALUES ('Trabalho'), ('Estudos'), ('Pessoal');