# Script rebuilds the sql, php classes and configuration for Propel
../vendor/propel/propel/bin/propel sql:build
../vendor/propel/propel/bin/propel model:build
../vendor/propel/propel/bin/propel config:convert
