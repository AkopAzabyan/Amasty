<?php

namespace First\Hello\Model;

use Magento\Checkout\Model\Cart;
use Magento\Framework\Message\ManagerInterface;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\App\Request\Http;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\File\Csv;
use Magento\Framework\Exception\LocalizedException;

class CsvImportHandler
{
    /**
     * @var Csv
     */
    private $csv;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var Cart
     */
    private $cart;
    /**
     * @var ManagerInterface
     */
    private $message;
    /**
     * @var Http
     */
    private $http;

    /**
     * CsvImportHandler constructor.
     * @param ProductRepository $productRepository
     * @param Csv $csv
     * @param ManagerInterface $message
     * @param Cart $cart
     * @param Http $http
     */
    public function __construct(
        ProductRepository $productRepository,
        Csv $csv,
        ManagerInterface $message,
        Cart $cart,
        Http $http
    )
    {
        $this->csv = $csv;
        $this->productRepository = $productRepository;
        $this->cart = $cart;
        $this->message = $message;
        $this->http = $http;
    }

    public function importFromCsvFile()
    {
        if ($file = $this->http->getFiles('importCsv')) {
            if (!isset($file['tmp_name'])) {
                throw new LocalizedException(__('Invalid file upload attempt.'));
            }
            $importProductRowData = $this->csv->getData($file['tmp_name']);
            $arrayColumn = [];
            foreach ($importProductRowData as $rowIndex => $dataRow) {
                $arrayColumn[] = $dataRow;
            }

            foreach ($arrayColumn as $value) {
                try {
                    $product = $this->productRepository->get($value[0]);
                    $idProduct = $product->getId();
                    $productType = $product->getTypeId();
                    if ($productType == 'simple') {
                        $params = [
                            'product' => $idProduct,
                            'qty' => $value[1]
                        ];
                        $this->cart->addProduct($product, $params);
                        $this->message->addSuccessMessage(__($value[0], 'Product add!'));
                    } else {

                        $this->message->addWarningMessage(__('Error'));
                        $this->http->setParams($params);
                    }


                } catch
                (\Exception $exception) {
                    $this->message->addErrorMessage(__($value[0], 'Product dont exist'));
                }
            }
            $this->cart->save();
        }
    }
}