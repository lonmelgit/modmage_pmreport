<?php

namespace ModMage\PmReport\Setup;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $conn = $setup->getConnection();
        $tableName = $setup->getTable('payment_history');
        if ($conn->isTableExists($tableName) != true) {
            $table = $conn->newTable($tableName)
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true]
                )
                ->addColumn(
                    'date',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => '']
                )
                ->addColumn(
                    'pm',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => '']
                )
                ->addColumn(
                    'qty',
                    Table::TYPE_INTEGER,
                    255,
                    ['nullable' => false, 'default' => '0.00']
                )
                ->addColumn(
                    'status',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => '']
                )
                ->addIndex(
                    $setup->getIdxName('payment_history', ['pm']),
                    ['pm']
                )
                ->setOption('charset', 'utf8');
            $conn->createTable($table);
        }
        $setup->endSetup();
    }
}
