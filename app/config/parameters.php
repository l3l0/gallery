<?php
$container->setParameter('cloudinary.url', getenv('CLOUDINARY_URL'));
$container->setParameter('mongohq.url', getenv('MONGOHQ_URL'));
$container->setParameter('mongolab.url', getenv('MONGOLAB_URL'));
