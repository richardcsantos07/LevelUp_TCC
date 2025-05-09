# LevelUp_TCC

## Visão Geral do Projeto
LevelUp_TCC é uma aplicação web educacional destinada a usuários institucionais, permitindo o registro, login e acesso a diversos jogos educacionais interativos. O objetivo é proporcionar uma plataforma de aprendizado divertida e acessível para crianças e educadores.

## Funcionalidades
- Registro e login de usuários institucionais
- Formulário de registro para instituições
- Integração com banco de dados MySQL para gerenciamento de usuários e dados dos jogos
- Interface responsiva, compatível com dispositivos móveis e desktops
- Jogos educacionais interativos para diferentes faixas etárias

## Tecnologias Utilizadas
- PHP para backend e gerenciamento de usuários
- MySQL para banco de dados
- HTML, CSS e JavaScript para frontend e jogos interativos
- Estrutura MVC para organização do código

## Instalação

1. Clone o repositório:
   ```bash
   git clone <repository-url>
   ```
2. Acesse o diretório do projeto:
   ```bash
   cd LevelUp_TCC
   ```
3. Configure o banco de dados MySQL:
   - Crie um banco de dados chamado `level_up`.
   - Importe o arquivo SQL localizado em `data/leveluptest.sql` para criar as tabelas necessárias.
4. Atualize o arquivo `php/config.php` com suas credenciais do banco de dados.

## Como Usar
- Abra o arquivo `php/index.php` em seu navegador para acessar a página de login.
- Utilize o formulário para registrar uma nova conta institucional ou faça login com credenciais existentes.
- Navegue pelos jogos disponíveis na plataforma após o login.

## Contribuições
Contribuições são bem-vindas! Para contribuir:
- Faça um fork do projeto
- Crie uma branch para sua feature (`git checkout -b feature/nome-da-feature`)
- Faça commit das suas alterações (`git commit -m 'Adiciona nova feature'`)
- Envie para o repositório remoto (`git push origin feature/nome-da-feature`)
- Abra um Pull Request para revisão

## Licença
Este projeto está licenciado sob a Licença MIT - veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## Contato
Para dúvidas ou sugestões, entre em contato pelo email: suporte@levelup.com.br

## Tutorial Completo: Como iniciar, atualizar e subir alterações no repositório Git

Este tutorial foi criado para ajudar você a iniciar um repositório Git local, conectar ao repositório remoto, fazer commits, atualizar sua branch com as últimas alterações e subir suas modificações para o repositório remoto.

### 1. Iniciando o repositório localmente

- Inicialize o repositório Git:
  ```bash
  git init
  ```

- Adicione o repositório remoto (origin):
  ```bash
  git remote add origin <url-do-repositorio>
  ```

### 2. Adicionando arquivos e fazendo commits

- Adicione os arquivos que deseja versionar:
  ```bash
  git add .
  ```

- Faça o commit das suas alterações:
  ```bash
  git commit -m "Mensagem do commit"
  ```

### 3. Criando e mudando para sua branch

- Crie uma nova branch para suas alterações:
  ```bash
  git checkout -b minha-branch
  ```

### 4. Atualizando sua branch com alterações do repositório remoto

- Busque as últimas alterações do repositório remoto:
  ```bash
  git fetch origin
  ```

- Atualize sua branch local com as alterações da branch principal (geralmente `main` ou `master`):
  ```bash
  git merge origin/main
  ```
  ou, se preferir rebase:
  ```bash
  git rebase origin/main
  ```

- Resolva quaisquer conflitos que possam surgir durante o merge ou rebase.

### 5. Subindo suas alterações para o repositório remoto

- Envie sua branch atualizada para o repositório remoto:
  ```bash
  git push origin minha-branch
  ```

### 6. Resolvendo erros comuns

- **Erro: "failed to push some refs"**  
  Isso acontece quando sua branch local está desatualizada em relação ao remoto. Para resolver, faça:
  ```bash
  git pull --rebase origin minha-branch
  git push origin minha-branch
  ```

- **Conflitos de merge/rebase**  
  Se ocorrerem conflitos, o Git vai avisar quais arquivos precisam ser resolvidos. Edite os arquivos para corrigir os conflitos, depois:
  ```bash
  git add <arquivo-resolvido>
  git rebase --continue
  ```
  ou, se estiver em merge:
  ```bash
  git commit
  ```

- **Erro: "remote origin already exists"**  
  Se você tentar adicionar o origin e receber esse erro, verifique o remoto configurado com:
  ```bash
  git remote -v
  ```
  Para alterar a URL do origin:
  ```bash
  git remote set-url origin <nova-url>
  ```

Seguindo este tutorial, você conseguirá trabalhar com o repositório Git de forma eficiente, mantendo sua branch atualizada e suas alterações sincronizadas com o repositório remoto.
  git remote set-url origin <nova-url>
  git push origin minha-branch
  git push origin minha-branch
  git rebase origin/main
  git fetch origin
  git checkout -b minha-branch
  git commit -m "Mensagem do commit"
  git add .
  git remote add origin <url-do-repositorio>
  git init
