#!/bin/bash

# clean old env
docker stop sti_project
docker rm -f sti_project

# download image
docker run -ti -d -p 8080:80 --name sti_project --hostname sti arubinst/sti:project2018

#docker run -ti -v "D:\HEIG-VD\SEMESTRE-5\STI\PROJET-1\STI-Projet1_Canton_Zaccaria\site":/usr/share/nginx/ -d -p 8080:80 --name sti_project --hostname sti arubinst/sti:project2018

#copy site and database folder into container (enelever dans le docker run l'option -v)
docker cp site/. sti_project:/usr/share/nginx/

#run web service
docker exec -u root sti_project service nginx start
#run php service
docker exec -u root sti_project service php5-fpm start