<?php

class TreeNode{
    public $val;

    public $left;

    public $right;

    public function __construct($val){
        $this->left = null;
        $this->right = null;
    }
}

class BinaryTree
{
    public TreeNode $root;

    public function __construct($root)
    {
        $this->root = $root;
    }

    public function size(){
        $size = 0;

        $this->_size($this->root, $size);

        return $size;
    }

    private function _size($node, &$size){
        if($node){
            $size++;
            $this->_size($node->left, $size);
            $this->_size($node->right, $size);
        }
    }
}

$root = new TreeNode(5);
$root->left = new TreeNode(1);
$root->right = new TreeNode(6);
$root->left->left = new TreeNode(3);
$root->right->left = new TreeNode(7);
$root->right->right = new TreeNode(4);

$binaryTree = new BinaryTree($root);

echo $binaryTree->size();