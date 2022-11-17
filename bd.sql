CREATE TABLE IF NOT EXISTS PERFIL(
    ID serial PRIMARY KEY NOT NULL,
    NOME varchar(50) NOT NULL
);


CREATE TABLE IF NOT EXISTS USUARIO(
    ID serial PRIMARY KEY NOT NULL,
    NOME varchar(120) NOT NULL ,
    EMAIL varchar(120) NOT NULL,
    TELEFONE varchar(11) NOT NULL,
    CREATED_AT timestamp   NOT NULL ,
    UPDATED_AT timestamp   NOT NULL ,
    LOGRADOURO varchar NOT NULL ,
    NUMERO varchar NOT NULL ,
    CEP varchar NOT NULL ,
    BAIRRO varchar NOT NULL,
    PERFIL_ID BIGINT NOT NULL,
    CONSTRAINT FK_PERFIL_ID FOREIGN KEY (PERFIL_ID) REFERENCES PERFIL(ID)
);

CREATE TABLE IF NOT EXISTS SERVICO(
    ID serial PRIMARY KEY NOT NULL,
    NOME varchar(100) NOT NULL ,
    DURACAO INT NOT NULL,
    VALOR DOUBLE PRECISION NOT NULL,
    CREATED_AT timestamp   NOT NULL ,
    UPDATED_AT timestamp   NOT NULL
);

CREATE TABLE IF NOT EXISTS AGENDAMENTO(
    ID serial PRIMARY KEY NOT NULL,
    CLIENTE_ID INT NOT NULL,
    FUNCIONARIO_ID INT NOT NULL,
    VALOR_TOTAL DOUBLE PRECISION NOT NULL,
    HORARIO TIME NOT NULL,
    DATA DATE NOT NULL,
    STATUS varchar(2) NOT NULL DEFAULT 1,
    CREATED_AT timestamp   NOT NULL ,
    UPDATED_AT timestamp   NOT NULL,
    CONSTRAINT FK_CLIENTE_ID  FOREIGN KEY(CLIENTE_ID) REFERENCES USUARIO(ID),
    CONSTRAINT FK_FUNCIONARIO_ID  FOREIGN KEY(FUNCIONARIO_ID) REFERENCES USUARIO(ID)
);

CREATE TABLE IF NOT EXISTS AGENDAMENTO_SERVICO(
    ID serial PRIMARY KEY NOT NULL,
    SERVICO_ID INT NOT NULL ,
    AGENDAMENTO_ID INT NOT NULL ,
    CREATED_AT timestamp   NOT NULL ,
    UPDATED_AT timestamp   NOT NULL,
    CONSTRAINT FK_SERVICO_ID FOREIGN KEY(SERVICO_ID) REFERENCES SERVICO(ID),
    CONSTRAINT FK_AGENDAMENTO_ID FOREIGN KEY(AGENDAMENTO_ID) REFERENCES AGENDAMENTO(ID)
)



