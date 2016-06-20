<?php
namespace contracts;

/*
    Contract for data access to the database
*/
interface IRepository
{
    public function ExecuteQuery($query);
}
?>
