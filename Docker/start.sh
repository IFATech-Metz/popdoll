#!/usr/bin/env sh

chown -R www-data ./data
apache2-foreground
