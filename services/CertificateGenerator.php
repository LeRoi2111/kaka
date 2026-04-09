<?php
namespace app\services;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;
use yii\base\Exception;

class CertificateGenerator
{
    private string $templatePath;
    private string $outputDir;

public function __construct()
{
    // Пробуем найти шаблон в обоих форматах
    $basePath = Yii::getAlias('@app/templates/1151156_template');

    if (file_exists($basePath . '.xlsx')) {
        $this->templatePath = $basePath . '.xlsx';
    } elseif (file_exists($basePath . '.xls')) {
        $this->templatePath = $basePath . '.xls';
    } else {
        $this->templatePath = $basePath . '.xlsx'; // fallback для ошибки
    }

    $this->outputDir = Yii::getAlias('@runtime/certificates');

    if (!is_dir($this->outputDir)) {
        mkdir($this->outputDir, 0755, true);
    }
}

    /**
     * Заполняет шаблон КНД 1151156 данными из документа и сохраняет как .xlsx
     * @param \app\models\Document $document
     * @return string Путь к сгенерированному файлу
     * @throws Exception
     */
    public function generate($document): string
    {
        Yii::info("Starting Excel generation for document #{$document->id}", __METHOD__);

        if (!file_exists($this->templatePath)) {
            throw new Exception('Шаблон не найден: ' . $this->templatePath);
        }

        // 1. Загружаем шаблон
        $spreadsheet = IOFactory::load($this->templatePath);


        // 2. Получаем активный лист (Стр. 001)
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Стр. 001');

        // 3. Подготавливаем данные
        $data = $this->prepareData($document);

        // 4. Заполняем ячейки согласно структуре КНД 1151156
        $this->fillCells($sheet, $data);

        // 5. Если пациент ≠ налогоплательщик, заполняем Стр. 002
        $this->fillPage2($spreadsheet, $document, $data);



        // 6. Сохраняем результат
        $fileName = 'Справка_КНД_1151156_' . ($document->document_number ?? $document->id) . '.xlsx';
        $outputFile = $this->outputDir . '/' . uniqid('cert_') . '.xlsx';

        $writer = new Xlsx($spreadsheet);
        $writer->save($outputFile);

        Yii::info("Excel generated: $outputFile", __METHOD__);
        return $outputFile;
    }

    private function prepareData($document): array
    {
        return [
            // Организация
            'org_name' => $document->organization->name ?? '',
            'org_inn' => $document->organization->inn ?? '',
            'org_kpp' => $document->organization->kpp ?? '',
            'org_license' => $document->organization->license_number ?? '',

            // Налогоплательщик (тот, кто платил)
            'taxpayer_last' => $document->patient->last_name ?? '',
            'taxpayer_first' => $document->patient->first_name ?? '',
            'taxpayer_middle' => $document->patient->middle_name ?? '',
            'taxpayer_inn' => $document->patient->inn ?? '',
            'taxpayer_birth' => $document->patient->birth_date ? date('d.m.Y', strtotime($document->patient->birth_date)) : '',
            'taxpayer_doc_code' => $document->patient->typePersonDocument->code ?? '',
            'taxpayer_doc_num' => $document->patient->document_series_number ?? '',
            'taxpayer_doc_date' => $document->patient->document_issue_date ? date('d.m.Y', strtotime($document->patient->document_issue_date)) : '',

            // Суммы по кодам услуг
            'amount_code_1' => number_format($this->sumByCode($document->id, '1'), 2, '.', ''),
            'amount_code_2' => number_format($this->sumByCode($document->id, '2'), 2, '.', ''),

            // Подписант
            'staff_fio' => trim("{$document->staff->last_name} {$document->staff->first_name} {$document->staff->middle_name}"),

            // Документ
            'doc_number' => $document->document_number ?? '',
            'doc_year' => $document->document_date ? date('Y', strtotime($document->document_date)) : date('Y'),
            'doc_date' => $document->document_date ? date('d.m.Y', strtotime($document->document_date)) : '',

            // Признак: один ли человек (упрощённо: всегда 1)
            'is_same_person' => '1',
        ];
    }

    /**
     * Заполняет Стр. 001 (основная страница справки)
     */
/**
 * Заполняет ячейки шаблона с учётом посимвольного формата КНД 1151156
 */
private function fillCells($sheet, array $data): void
{
    // === Вспомогательная функция: записать строку посимвольно в массив ячеек ===
    $fillChars = function($sheet, string $value, array $cells, int $maxLength = null) {
        $chars = mb_str_split(preg_replace('/[^0-9A-ZА-ЯЁ]/ui', '', $value)); // очистка от лишних символов
        $limit = $maxLength ?? count($cells);

        foreach (array_slice($cells, 0, $limit) as $i => $cellAddr) {
            $char = $chars[$i] ?? '';
            $sheet->setCellValue($cellAddr, $char);
        }
    };

    // === ШАПКА ===
    // ИНН организации (12 символов) - ячейки из вашего файла
    $innOrgCells = ['Y1','AA1','AC1','AE1','AG1','AL1','AK1','AM1','AO1','AQ1','AS1','AU1'];
    $fillChars($sheet, $data['org_inn'], $innOrgCells, 12);

    // КПП организации (9 символов) - уточните ячейки, пока заглушка
    // $fillChars($sheet, $data['org_kpp'], ['H6','I6',...], 9);

    // Номер справки (до 50 символов, но в форме обычно ~20)
    // $fillChars($sheet, $data['doc_number'], ['B10','C10',...], 20);

    // Отчетный год (4 цифры)
    $fillChars($sheet, $data['doc_year'], ['AG10','AH10','AI10','AJ10'], 4);

    // === ОРГАНИЗАЦИЯ ===
    // Наименование - обычно в одну широкую ячейку (не посимвольно)
    $sheet->setCellValue('B14', $data['org_name']);
    $sheet->setCellValue('B15', $data['org_license']);

    // === НАЛОГОПЛАТЕЛЬЩИК ===
    // ФИО - обычно в отдельные строки, не посимвольно
    $sheet->setCellValue('B18', $data['taxpayer_last']);
    $sheet->setCellValue('B19', $data['taxpayer_first']);
    $sheet->setCellValue('B20', $data['taxpayer_middle']);

    // ИНН налогоплательщика (10 или 12 символов) - те же ячейки, что и для организации
    $fillChars($sheet, $data['taxpayer_inn'], $innOrgCells, 12);

    // Дата рождения (формат ДД.ММ.ГГГГ = 10 символов с точками)
    $birthCells = ['H21','I21','J21','K21','L21','M21','N21','O21','P21','Q21']; // уточните
    $fillChars($sheet, $data['taxpayer_birth'], $birthCells, 10);

    // === ДОКУМЕНТ ЛИЧНОСТИ ===
    $sheet->setCellValue('B23', $data['taxpayer_doc_code']);   // Код вида - обычно 2 цифры в одну ячейку
    // Серия/номер - посимвольно, уточните ячейки
    // $fillChars($sheet, $data['taxpayer_doc_num'], [...], 10);

    // === СУММЫ ===
    // Суммы имеют формат "12345.67" (до 15 символов с точкой)
    // Уточните ячейки для кода "1"
    // $fillChars($sheet, $data['amount_code_1'], [...], 15);
    // $fillChars($sheet, $data['amount_code_2'], [...], 15);

    // === ПОДПИСЬ ===
    $sheet->setCellValue('B33', $data['staff_fio']);
    // Дата подписи - посимвольно, аналогично дате рождения
}

    /**
     * Заполняет Стр. 002 (если пациент ≠ налогоплательщик)
     * В упрощённой версии пропускаем, т.к. считаем их одним лицом
     */
    private function fillPage2($spreadsheet, $document, array $data): void
    {
        // Если в будущем потребуется поддержка разных лиц:
        // $sheet2 = $spreadsheet->getSheetByName('Стр. 002') ?? $spreadsheet->createSheet();
        // $sheet2->setTitle('Стр. 002');
        // ... заполнение ячеек ...
    }

    /**
     * Суммирует услуги по коду (1 = лечение, 2 = медикаменты)
     */
    private function sumByCode(int $docId, string $code): float
    {
        return (new \yii\db\Query())
            ->from('document_service ds')
            ->innerJoin('service s', 'ds.service_id = s.id')
            ->where(['ds.document_id' => $docId, 's.code' => $code])
            ->sum('ds.amount') ?: 0.00;
    }
}