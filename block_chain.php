<?php

class Block {
    private $timestamp;
    private $data;
    private $previousHash;
    private $hash;

    public function __construct($timestamp, $data, $previousHash) {
        $this->timestamp = $timestamp;
        $this->data = $data;
        $this->previousHash = $previousHash;
        $this->hash = $this->calculateHash();
    }

    private function calculateHash() {
        $hashString = $this->timestamp . json_encode($this->data) . $this->previousHash;
        return hash('sha256', $hashString);
    }

    public function getHash() {
        return $this->hash;
    }
}

class Blockchain {
    private $chain;

    public function __construct() {
        $this->chain = [$this->createGenesisBlock()];
    }

    private function createGenesisBlock() {
        $timestamp = time();
        return new Block($timestamp, 'Genesis Block', '0');
    }

    public function getLatestBlock() {
        return $this->chain[count($this->chain) - 1];
    }

    public function addBlock($newBlock) {
        $newBlock->previousHash = $this->getLatestBlock()->getHash();
        $newBlock->hash = $newBlock->calculateHash();
        $this->chain[] = $newBlock;
    }

    public function isChainValid() {
        for ($i = 1; $i < count($this->chain); $i++) {
            $currentBlock = $this->chain[$i];
            $previousBlock = $this->chain[$i - 1];

            if ($currentBlock->getHash() !== $currentBlock->calculateHash()) {
                return false;
            }

            if ($currentBlock->previousHash !== $previousBlock->getHash()) {
                return false;
            }
        }

        return true;
    }
}

// Create a blockchain and add some blocks
$myBlockchain = new Blockchain();
$myBlockchain->addBlock(new Block(time(), ['amount' => 5], ''));
$myBlockchain->addBlock(new Block(time(), ['amount' => 10], ''));
$myBlockchain->addBlock(new Block(time(), ['amount' => 15], ''));

// Print the blockchain
foreach ($myBlockchain->chain as $block) {
    echo "Timestamp: " . $block->timestamp . "\n";
    echo "Data: " . json_encode($block->data) . "\n";
    echo "Hash: " . $block->getHash() . "\n";
    echo "Previous Hash: " . $block->previousHash . "\n";
    echo "-----------------------------\n";
}
