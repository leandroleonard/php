<?php

class Node 
{
    public int $val;
    public ?Node $left;
    public ?Node $right;

    function __construct(int $val){
        $this->val = $val;
        $this->left = null;
        $this->right = null;
    }
}

class BinaryTree
{
    public ?Node $root;

    function __construct(){
        $this->root = null;
    }

    public function insert(int $val)
    {
        if (!$this->root){
            $this->root = new Node($val);
        }else{
            $this->insert_recursivly($this->root, $val);
        }
    }

    private function insert_recursivly(Node $node, int $val)
    {
        if($val < $node->val){
            if(!$node->left){
                $node->left = new Node($val);
            }else{
                $this->insert_recursivly($node->left, $val);
            }
        }else{
            if(!$node->right){
                $node->right = new Node($val);
            }else{
                $this->insert_recursivly($node->right, $val);
            }
        }
    }

    public function search(int $val): bool{
        return $this->search_recursivly($this->root, $val);
    }

    private function search_recursivly(?Node $node, int $val)     : bool
    {
        if(!$node) return false;

        if ($node->val == $val) return true;

        if($val < $node->val) return $this->search_recursivly($node->left, $val);
        
        return $this->search_recursivly($node->right, $val);
    }
}

$binaryTree = new BinaryTree();

$binaryTree->insert(1);
$binaryTree->insert(10);
$binaryTree->insert(7);
$binaryTree->insert(3);

var_dump($binaryTree->search(10));
var_dump($binaryTree->search(4));