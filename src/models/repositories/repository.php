<?php

interface Repository {
    function findAll();
    function findById($id);
    function save($entity);
    function delete($id);
}
