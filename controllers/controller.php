<?php

interface  Controller{

    public function handleRequest();
    public function handleReturnAll();
    public function handleCreate();
    public function handleUpdate();
    public function handleDelete();
}