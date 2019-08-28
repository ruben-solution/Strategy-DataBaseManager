<?php

class MySQLConn implements SQLStrategy
{
    private $conn;
    private $charsets = [
        'big5',     // Big5 Traditional Chinese
        'dec8',     // DEC West European
        'cp850',    // DOS West European
        'hp8',      // HP West European
        'koi8r',    // KOI8-R Relcom Russian
        'latin1',   // cp1252 West European
        'latin2',   // ISO 8859-2 Central European
        'swe7',     // 7bit Swedish
        'ascii',    // US ASCII
        'ujis',     // EUC-JP Japanese
        'sjis',     // Shift-JIS Japanese
        'hebrew',   // ISO 8859-8 Hebrew
        'tis620',   // TIS620 Thai
        'euckr',    // EUC-KR Korean
        'koi8u',    // KOI8-U Ukrainian
        'gb2312',   // GB2312 Simplified Chinese
        'greek',    // ISO 8859-7 Greek
        'cp1250',   // Windows Central European
        'gbk',      // GBK Simplified Chinese
        'latin5',   // ISO 8859-9 Turkish
        'armscii8', // ARMSCII-8 Armenian
        'utf8',     // UTF-8 Unicode
        'ucs2',     // UCS-2 Unicode
        'cp866',    // DOS Russian
        'keybcs2',  // DOS Kamenicky Czech-Slovak
        'macce',    // Mac Central European
        'macroman', // Mac West European
        'cp852',    // DOS Central European
        'latin7',   // ISO 8859-13 Baltic
        'utf8mb4',  // UTF-8 Unicode
        'cp1251',   // Windows Cyrillic
        'utf16',    // UTF-16 Unicode
        'cp1256',   // Windows Arabic
        'cp1257',   // Windows Baltic
        'utf32',    // UTF-32 Unicode
        'binary',   // Binary pseudo charset
        'geostd8',  // GEOSTD8 Georgian
        'cp932',    // SJIS for Windows Japanese
        'eucjpms'   // UJIS for Windows Japanese
    ];

    /**
     * @param string $hostname
     * @param string $username
     * @param string $password
     * @param string $database
     * @param array  $options
     * @param string $names
     */
    function __construct($hostname, $username, $password, $database, $options=[], $names='utf8mb4')
    {
        $this->conn = new PDO(
            'mysql:host=' . $hostname . ';dbname=' . $database,
            $username,
            $password,
            $options
        );

        $this->setNames($names);
    }

    private function setNames($names): void
    {
        $names = strtolower($names);

        if (in_array($names, $this->charsets)) {
            $this->conn->query('SET NAMES ' . $names);
        }
    }

    /**
     * Gets all requested rows
     *
     * @param string $query
     * @param array  $params
     *
     * @return array
     */
    public function all($query, $params): array
    {
        $stmt = $this->conn->prepare($query);

        $stmt->execute($params);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;

        return $result;
    }

    /**
     * Returns one row of query result
     *
     * @param string $query
     * @param array  $params
     *
     * @return array
     */
    public function one($query, $params): array
    {
        $stmt = $this->conn->prepare($query);

        $stmt->execute($params);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = null;

        return $result;
    }

    public function change($query, $params): bool
    {
        $stmt = $this->conn->prepare($query);

        return $stmt->execute($params);
    }
}
