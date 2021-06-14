<?php
//
//include 'framework/Repository.php';
//include 'framework/DBConfig.php';
//include 'framework/Controller.php';
//include '2.php';
//
//$repo = new Repository(
//    (new DBConfig())
//        ->setHostname('localhost')
//        ->setUsername('root')
//        ->setPassword('1234')
//        ->setDatabase('mydb'),
//    MyModel::class
//);
//
//$controller = new MyModelController(
//    $repo
//);
//
//$controller->delete(2)();

//function printModel($object) {
//    global $repo;
//    print $repo->getModelDecorator()
//        ->asString($object);
//}

//printModel(
//    $repo->create(
//        new MyModel(
//            'Misha',
//            13,
//            new DateTime('now')
//        )
//    )
//);
//print join(' ', array_map(function ($m) {printModel($m);}, $repo->findAll()));
//print $repo->delete(1);
//print join(' ', array_map(function ($m) {printModel($m);}, $repo->findAll()));
//print join(' ', $repo->findAll());
//
//$mishka = $repo->findById(2);
//printModel($mishka);
//$repo->update((new MyModel('NeMishake', 15, $mishka->birth_date))->setId(2));


/**
 * @Route('/f')
 */
function f () {

}

$r = new ReflectionFunction('f');
print $r->getDocComment();

