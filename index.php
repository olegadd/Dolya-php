<?php

echo "It's my project" . "<br>";

// Задание 1
$name = 'олег';
$surname = 'доля';
$patronomyc = 'альбертович';

echo mb_convert_case($surname, MB_CASE_TITLE, "UTF-8") . ' '
    . mb_strtoupper(mb_substr($name, 0, 1)) . '.'
    . mb_strtoupper(mb_substr($patronomyc, 0, 1)) . '.' . "<br>";

// Задание 2
$year = 2021;

for ($month = 1; $month <= 12; $month++) {
    for ($day = 1; $day <= 20; $day++) {
        $timestamp = mktime(0, 0, 0, $month, $day, $year);
        if (date('N', $timestamp) == 6) {
            echo date('d.m.Y', $timestamp) . "<br>";
        }
    }
}

// OOP

abstract class Animal
{
    protected $name;
    private $age;

    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function eat(): string
    {
        return "<b>{$this->name}</b> ест";
    }

    public function sleep(): string
    {
        return "<b>{$this->name}</b> спит";
    }

    abstract public function makeSound(): string;
}

class Cat extends Animal
{
    public function makeSound(): string
    {
        return "Кот <b>{$this->name}</b> издает звук МЯУ";
    }

    public function scratch(): string
    {
        return "<b>{$this->name}</b> царапает";
    }
}

class Dog extends Animal
{
    public function makeSound(): string
    {
        return "Пес <b>{$this->name}</b> издает звук ГАВ";
    }

    public function biting(): string
    {
        return "<b>{$this->name}</b> кусает";
    }
}

class Bird extends Animal
{
    public function makeSound(): string
    {
        return "Птица <b>{$this->name}</b> издает звук ФЬЮТЬ";
    }

    public function fly(): string
    {
        return "<b>{$this->name}</b> летит";
    }
}

class Tiger extends Animal
{
    public function makeSound(): string
    {
        return "Тигр <b>{$this->name}</b> издает звук РЫК";
    }

    public function scratch(): string
    {
        return "<b>{$this->name}</b> царапает";
    }
}

function testAnimal(Animal $animal): void
{
    echo "Имя животного: " . '<b>' . $animal->getName() . '</b>' . "<br>";
    echo "Возраст животного: " . '<b>' . $animal->getAge() . '</b>' . "<br>";
    echo $animal->eat() . "<br>";
    echo $animal->sleep() . "<br>";
    echo $animal->makeSound() . "<br>";

    if ($animal instanceof Cat) {
        echo $animal->scratch() . "<br>";
    } elseif ($animal instanceof Dog) {
        echo $animal->biting() . "<br>";
    } elseif ($animal instanceof Bird) {
        echo $animal->fly() . "<br>";
    } elseif ($animal instanceof Tiger) {
        echo $animal->scratch() . "<br>";
    }
}

$cats = [
    new Cat("Феликс", 1),
    new Cat("Локи", 2),
    new Cat("Марсик", 4),
];

$dogs = [
    new Dog("Персик", 4),
    new Dog("Чарли", 2),
    new Dog("Макс", 8),
];

$birds = [
    new Bird("Ара", 3),
    new Bird("Вилли", 1),
    new Bird("Бени", 6),
];

$tigers = [
    new Tiger("Блейз", 5),
    new Tiger("Зара", 8),
    new Tiger("Шива", 11),
];

echo "<br>";
echo "<b>Коты:</b>" . "<br>";
foreach ($cats as $cat) {
    testAnimal($cat);
}
echo "<br>";

echo "<b>Собаки:</b>" . "<br>";
foreach ($dogs as $dog) {
    testAnimal($dog);
}
echo "<br>";

echo "<b>Птицы:</b>" . "<br>";
foreach ($birds as $bird) {
    testAnimal($bird);
}
echo "<br>";

echo "<b>Тигры:</b>" . "<br>";
foreach ($tigers as $tiger) {
    testAnimal($tiger);
}
echo "<br>";

echo "<b>Полиморфизм:</b>" . "<br>";
$allAnimals = array_merge($cats, $dogs, $birds, $tigers);
foreach ($allAnimals as $animal) {
    echo '<b>' . $animal->getName() . '</b>' . ": " . $animal->makeSound() . "<br>";
}
