# 🛒 SymfoPop

Una aplicació web de mercat de segona mà construïda amb **Symfony 7**, **Doctrine ORM**, **Twig** i **Bootstrap 5**.

---

## ✨ Funcionalitats

- 👤 Registre i inici de sessió d'usuaris amb "Recorda'm"
- 🛒 Catàleg públic de productes visible per a tothom
- ➕ Els usuaris autenticats poden publicar els seus propis productes
- ✏️ Editar i esborrar els teus propis productes
- 🔒 Validació de permisos (només el propietari pot editar/esborrar)
- 💬 Missatges flash per a totes les accions
- 🛡️ Protecció CSRF en tots els formularis
- 📱 Disseny totalment responsiu amb Bootstrap 5

---

## 🛠️ Tecnologies Utilitzades

- PHP 8.1+
- Symfony 7
- Doctrine ORM
- Twig
- Bootstrap 5
- MySQL / MariaDB

---

## 🚀 Instal·lació

### 1. Clona el repositori
```bash
git clone https://github.com/YOUR_USERNAME/symfopop.git
cd symfopop
```

### 2. Instal·la les dependències PHP
```bash
composer install
```

### 3. Configura l'entorn
Copia el fitxer d'exemple i omple les teves credencials:
```bash
cp .env.example .env
```

Edita `.env` i configura la connexió a la base de dades:
```env
DATABASE_URL="mysql://root:la_teva_contrasenya@127.0.0.1:3306/symfopop?serverVersion=8.0&charset=utf8mb4"
```

### 4. Crea la base de dades
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 5. Carrega les dades de prova (fixtures)
```bash
php bin/console doctrine:fixtures:load
```

Això crearà **5 usuaris** i **20 productes** amb dades realistes.

### 6. Inicia el servidor de desenvolupament
```bash
symfony serve
```

Obre el navegador a: **http://127.0.0.1:8000**

---

## 🔑 Credencials de Prova

Tots els usuaris de les fixtures comparteixen la mateixa contrasenya:

| Nom | Email | Contrasenya |
|-----|-------|-------------|
| Carlos Martínez | carlos@example.com | password123 |
| Laura Sánchez | laura@example.com | password123 |
| Miguel Torres | miguel@example.com | password123 |
| Ana García | ana@example.com | password123 |
| David López | david@example.com | password123 |

---

## 📁 Estructura del Projecte
```
symfopop/
├── config/
│   └── packages/
│       └── security.yaml
├── src/
│   ├── Controller/
│   │   ├── HomeController.php
│   │   ├── ProductController.php
│   │   ├── RegistrationController.php
│   │   └── SecurityController.php
│   ├── Entity/
│   │   ├── Product.php
│   │   └── User.php
│   ├── Form/
│   │   ├── ProductType.php
│   │   └── RegistrationFormType.php
│   ├── Repository/
│   │   ├── ProductRepository.php
│   │   └── UserRepository.php
│   ├── Security/
│   │   └── LoginFormAuthenticator.php
│   └── DataFixtures/
│       └── AppFixtures.php
├── templates/
│   ├── base.html.twig
│   ├── product/
│   │   ├── index.html.twig
│   │   ├── show.html.twig
│   │   ├── new.html.twig
│   │   └── edit.html.twig
│   ├── registration/
│   │   └── register.html.twig
│   └── security/
│       └── login.html.twig
├── migrations/
├── .env.example
└── README.md
```

---

## 🔒 Bones Pràctiques de Seguretat

- Les contrasenyes es guarden hashejades amb bcrypt
- Tots els formularis estan protegits amb tokens CSRF
- Les rutes estan protegides amb `#[IsGranted('ROLE_USER')]`
- Només el propietari del producte el pot editar o esborrar
- Escapament automàtic de variables a Twig (protecció XSS)

---

## 👨‍💻 Autor

Projecte desenvolupat per **Mohammed** com a part d'un projecte d'aprenentatge de Symfony.