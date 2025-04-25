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
