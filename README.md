# Kate Syntax Highlighting

Some improved syntax highlighting for Kate, the KDE advanced text editor. Mainly
syntax for web programming languages.

Use PHP as XML generators. It save a lot of efforts. You can share common data
between different syntax.

## What is included

- Stylesheets
  - CSS
  - LESS
  - SCSS
  - Stylus
- Scripts
  - TypeScript (TODO)
  - JSX (TODO)
  - TSX (TODO)
- HTML Templates
  - Smarty (TODO)
  - Twig (TODO)
  - Blade
  - Jade/Pug

Syntax     | Development status | Kate release
-----------|--------------------|-------------
CSS        | Done               | Released
SCSS       | Done               | Released
Blade      | Done               |
Jade/Pug   | Done               |
LESS       | Done               |
Stylus     | Todo               |
TypeScript | Todo               |
JSX        | Todo               |
TSX        | Todo               |
Smarty     | Todo               |
Twig       | Todo               |


## How to use it

Syntax highlighting files will be pushed into official Kate repository when they
are ready. However, this process is probably **very slow** because I am not a
team member of Kate project. Each patch requires reviewing and it usually takes
months. If you need it urgently, just clone through git or download zip, then
run `make install`. To uninstall, run `make uninstall`.
