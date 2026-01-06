<?php

class Solution {

    /**
     * @param TreeNode $root
     * @return int
     */
    function maxDepth($root) {
        if(!$root) return 0;

        $lDepth = $this->maxDepth($root->left);
        $rDepth = $this->maxDepth($root->right);
        
        return max($lDepth, $rDepth) + 1;
    }
}

