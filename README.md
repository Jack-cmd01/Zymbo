# 🎉 Zymbo - Sistema de Eventos

Nosso objetivo é desenvolver uma plataforma que conecte pessoas à organizadores de eventos.


## 🧪 Como Rodar o Projeto

1. Instale o XAMPP (ou similar)
2. Coloque a pasta `Zymbo` dentro de `htdocs`
3. Inicie o Apache e MySQL no XAMPP
4. Crie o banco `zymbo_db` no phpMyAdmin
5. Execute o SQL para criar as tabelas:

```
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_evento VARCHAR(100) NOT NULL,
    modalidade ENUM('presencial', 'online') NOT NULL,
    valor VARCHAR(50) NOT NULL,
    localizacao VARCHAR(255) NOT NULL,
    horario TIME NOT NULL,
    data DATE NOT NULL,
    descricao TEXT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
# Acesse via Navegador 🌎
http://localhost/Zymbo/index.html



## 🚀 Funcionalidades

- Cadastro de eventos (Tipo, modalidade, valor, localização, data, horário, descrição)
- Cadastro de Usuário (Nome, e-mail, senha)
- Validação de Usuário (Login)
- Exibição de cards de eventos
- Sistema de mensagens estilizadas para sucesso e erro
- Integração com banco de dados via mysqli

--

## 🛠️ Tecnologias Utilizadas

- HTML5
- CSS3
- PHP (procedural)
- MySQL (phpMyAdmin via XAMPP)
- XAMPP (Ambiente de desenvolvimento local)


⚙️  Estrutura do Projeto  ⚙️

Zymbo/                                                                                                                                                                                    
├── public/                     ← Arquivos que são diretamente acessíveis pelo navegador                                                                                                
│   ├── index.html              ← Página inicial (landing Page)                                                                                                                        
│   ├── cadastro.html           ← Formulário de cadastro de usuário                                                                                                                    
│   ├── cadastroEv.html         ← Formulário de cadastro de evento                                                                                                                    
│   ├── login.html              ← Formulário de login                                                                                                                                
│   ├── emConstrucao.html       ← Página “Em construção” (404 ou recurso não disponível)                                                                                                
│   └── assets/                 ← Arquivos estáticos (CSS, JavaScript, imagens)                                                                                                        
│       ├── css/                                                                                                                                                                        
│       │   └── style.css       ← Estilos globais do projeto                                                                                                                        
│       ├── js/                                                                                                                                                                        
│       │   └── main.js         ← Scripts JavaScript                                                                                                                                    
│       └── images/                                                                                                                                                                    
│           └── imagens.jpg     ← Imagens e icones diversos                                                                                                                            
│                                                                                                                                                                                        
├── actions/                    ← “Controladores” no sentido mais simples: scripts que recebem formulários e fazem INSERT/UPDATE/DELETE                                                
│   ├── salvar.php              ← Recebe o POST de cadastro de usuário (cadastra no banco)                                                                                                
│   ├── salvarEv.php            ← Recebe o POST de cadastro de evento (cadastra no banco)                                                                                                
│   ├── verifica.php            ← Recebe o POST de login (verifica credenciais)                                                                                                        
│   └── excluir.php             ← Recebe a chamada para deletar um evento (via GET ou POST)                                                                                            
│                                                                                                                                                                                        
├── config/                     ← Arquivos de configuração, constantes, chaves, etc.                                                                                                    
│   └── config.php              ← Exemplo: Configurações extras de Usuários.                                                                                                            
│                                                                                                                                                                                        
├── vendor/                     ← Dependências instaladas via Composer (PHPMAILER)                                                                                                        
│   ├── autoload.php                                                                                                                                                                    
│   └── (demais pacotes)                                                                                                                                                                
│                                                                                                                                                                                        
└── composer.json               ← Arquivo de controle de dependências (Sem uso no momento)                                                                                                



cd C:/ADS/D1/Programacao_De_Computadores/Mentoria_Karla_Sartin

<Desenvolvido por:"Celso de Jesus Nunes Filho" RGM:"35919167">                                                                                                                            
<Desenvolvido por:"Guilherme Tavares Pinheiro Moura" RGM:"35974664">                                                                                                                    
<Desenvolvido por:"João Carlos de Souza Carvalho" RGM:"36027022">                                                                                                                        
<Desenvolvido por:"Pedro Henrique Mendes dos Santos" RGM:"35563991">                                                                                                                    
</UDF>                                                                                                                                                                                                
