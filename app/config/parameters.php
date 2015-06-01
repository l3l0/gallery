<?php
$container->setParameter('mongolab.url', getenv('MONGOLAB_URI'));
$container->setParameter('mongolab.default_database', current(array_reverse(explode('/', getenv('MONGOLAB_URI')))));
