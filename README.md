
# 🌵 Caapedia - Jogo de Simulação e Sustentabilidade no Semiárido

Caapedia é um jogo de simulação focado na gestão de recursos, sustentabilidade e cultura da agricultura familiar no semiárido brasileiro. O projeto tem como objetivo promover o conhecimento sobre práticas sustentáveis, economia local e manejo dos recursos naturais, valorizando a cultura e os saberes da região.

> 🔗 Site do projeto: [caapedia.fernandopc.dev.br](https://caapedia.fernandopc.dev.br)

> 🔗 Jogar: [jogarcaapedia.fernandopc.com.br](https://jogarcaapedia.fernandopc.com.br)

## 🚀 Tecnologias Utilizadas

- [Laravel](https://laravel.com/) - Backend robusto em PHP
- [Livewire](https://livewire.laravel.com/) - Componentização reativa para Laravel
- [Tailwind CSS](https://tailwindcss.com/) - Framework CSS utilitário
- [DaisyUI](https://daisyui.com/) - Componentes UI sobre Tailwind
- [Mary UI](https://mary-ui.com/) - Extensões UI para aplicações modernas

## 🎮 Funcionalidades

- 🌾 Simulação de produção agrícola e pecuária
- 🏗️ Construção de infraestruturas para criação e manufatura
- 💧 Gestão de recursos como água e degradação ambiental
- 💰 Sistema financeiro com fluxo de caixa, empréstimos e comércio de produtos
- 🧑 Personagens e histórias interativas
- 🌍 Sustentabilidade e impacto ambiental como mecânica central

## 🏗️ Instalação e Desenvolvimento Local

### Pré-requisitos

- PHP 8.2+
- Composer
- Node.js 18+
- MySQL ou MariaDB

### Instalação

Clone o projeto:

```bash
git clone https://github.com/seu-usuario/caapedia.git
cd caapedia
```

Instale as dependências PHP:

```bash
composer install
```

Instale as dependências JS e compile os assets:

```bash
npm install
npm run dev
```

Configure o ambiente:

```bash
cp .env.example .env
php artisan key:generate
```

Configure o banco de dados no arquivo `.env` e execute as migrations:

```bash
php artisan migrate --seed
```

Inicie o servidor:

```bash
php artisan serve
```

Acesse em: [http://localhost:8000](http://localhost:8000)

## 📄 Licença

Este projeto está licenciado sob a licença [MIT](LICENSE.md).

## 🔒 Políticas e Privacidade

O Caapedia respeita seus dados e sua privacidade. Consulte nossas [Políticas de Privacidade](https://caapedia.fernandopc.dev.br/caapedia/termos/pol%C3%ADticas-de-privacidade) para mais informações.

## 🙌 Contribuição

Sinta-se livre para contribuir! Envie pull requests, abra issues ou sugira melhorias.

## 💡 Referências e Agradecimentos

- [Sobre o Caapedia](https://caapedia.fernandopc.dev.br/caapedia/sobre)
- Inspirado na cultura, saberes e práticas da agricultura familiar no semiárido brasileiro.

---
Desenvolvido com 💚 por [Fernando Pereira Coelho](https://github.com/fernandopc1996)