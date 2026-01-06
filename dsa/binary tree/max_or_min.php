<?php

class TreeNode{
    public $val;

    public $left;

    public $right;

    public function __construct($val){
        $this->val = $val;
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
}

function getMax(?TreeNode $node): int{
    if(!$node)
        return PHP_INT_MIN;

    return max($node->val, getMax($node->left), getMax($node->right));
}

function getMin(?TreeNode $node): int{
    if(!$node) return PHP_INT_MAX;

    return min($node->val, getMin($node->left), getMin($node->right));
}


$root = new TreeNode(5);
$root->left = new TreeNode(1);
$root->right = new TreeNode(6);
$root->left->left = new TreeNode(3);
$root->right->left = new TreeNode(7);
$root->right->right = new TreeNode(4);

$binaryTree = new BinaryTree($root);

echo "Max value in BT: " . getMax($binaryTree->root) . PHP_EOL;
echo "Min value in BT: " . getMin($binaryTree->root) . PHP_EOL;

