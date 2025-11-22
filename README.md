# Comandos de Desarrollo

## Rector

Generar archivo de configuración:
```bash
./vendor/bin/sail php vendor/bin/rector
```

Ver cambios sin aplicar (dry-run):
```bash
./vendor/bin/sail php vendor/bin/rector process --dry-run
```

Aplicar cambios:
```bash
./vendor/bin/sail php vendor/bin/rector process
```

## Laravel IDE Helper

Generar helper general (facades, etc.):
```bash
./vendor/bin/sail php artisan ide-helper:generate
```

Generar tipos en los modelos:
```bash
./vendor/bin/sail php artisan ide-helper:models --write
```

Generar tipos en archivo separado:
```bash
./vendor/bin/sail php artisan ide-helper:models --nowrite
```

Generar helper para PhpStorm (meta file):
```bash
./vendor/bin/sail php artisan ide-helper:meta
```
