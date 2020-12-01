#!/bin/bash

mkdir $1
cd $1
mkdir css img js tpl php

cd css
mkdir user admin
echo | cat > user/estilo.css
echo | cat > admin/estilo.css

cd ../img
mkdir avatars buttons products pets

cd ../js
mkdir validations effects
cd validations
echo | cat > login.js
echo | cat > register.js
cd ../effects
echo | cat > panels.js
cd ..


cd ../tpl
echo | cat > main.tpl 
echo | cat > login.tpl 
echo | cat > register.tpl 
echo | cat > panel.tpl 
echo | cat > profile.tpl 
echo | cat > crud.tpl


cd ../php
echo | cat > create.php
echo | cat > read.php 
echo | cat > update.php 
echo | cat > delete.php 
echo | cat > dbconect.php
