<?php

class BlackList
{
    public $name;
    public $reasonForBlock;
    public $date;
    public $file;

    public function __construct()
    {
        $this->name = $_POST['name'];
        $this->reasonForBlock = $_POST['reasonForBlocking'];
        $this->date = date("Y-m-d H:i:s");
        $this->file = "blackList.txt";
    }

    public function issetFile()
    {
        if (!file_exists($this->file))
        {
            file_put_contents($this->file, '');
        }
    }

    public function personSearch()
    {
        if (strpos(file_get_contents('blacklist.txt'), $this->name))
        {
            return true;
        } else {
            return false;
        }
    }

    public function addInBlackList()
    {
        $data = "Name: $this->name\nReason for blocking: $this->reasonForBlock\nDate block: $this->date\n";
        file_put_contents($this->file, $data, FILE_APPEND);
    }
}

$blacklist = new BlackList();
$blacklist->issetFile();

if ($blacklist->personSearch())
{
    echo "Пользователь - $blacklist->name уже заблокирован";
} else {
    $blacklist->addInBlackList();
    echo "Пользователь - $blacklist->name добавлен в blacklist.\n
    Причина блокировки - $blacklist->reasonForBlock";
}