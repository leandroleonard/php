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

    public function preorder(): array{
        $result = [];

        $this->preorder_traversal($this->root, $result);

        return $result;
    }

    private function preorder_traversal(?Node $node, array &$result){
        if ($node){
            $result[] = $node->val;
            $this->preorder_traversal($node->left, $result);
            $this->preorder_traversal($node->right, $result);
        }
    }


    public function postorder(): array{
        $result = [];

        $this->postorder_traversal($this->root, $result);

        return $result;
    }

    private function postorder_traversal(?Node $node, array &$result){
        if ($node){
            $this->postorder_traversal($node->left, $result);
            $this->postorder_traversal($node->right, $result);
            $result[] = $node->val;
        }
    }


    public function inorder(): array{
        $result = [];

        $this->inorder_traversal($this->root, $result);

        return $result;
    }

    private function inorder_traversal(?Node $node, array &$result){
        if ($node){
            $this->inorder_traversal($node->left, $result);
            $result[] = $node->val;
            $this->inorder_traversal($node->right, $result);
        }
    }

    public function dfs(int $val): bool
    {

        return $this->dfs_recursivly($this->root, $val);
    }

    private function dfs_recursivly(?Node $node, int $val)
    {
        if(!$node) return false;

        if ($node->val == $val) return true;

        if($this->dfs_recursivly($node->left, $val)) return true;

        if($this->dfs_recursivly($node->right, $val)) return true;
    }

    
}

$binaryTree = new BinaryTree();

$binaryTree->insert(5);
$binaryTree->insert(3);
$binaryTree->insert(1);
$binaryTree->insert(10);
$binaryTree->insert(7);
$binaryTree->insert(15);
$binaryTree->insert(20);

// var_dump($binaryTree->search(10));
// var_dump($binaryTree->search(4));

// var_dump($binaryTree->preorder());
// var_dump($binaryTree->inorder());
// var_dump($binaryTree->postorder());

var_dump($binaryTree->dfs(200));