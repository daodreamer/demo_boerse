#!/bin/bash
cp /home/site/wwwroot/azure/nginx.conf /etc/nginx/sites-available/default
service nginx reload
