<?php

declare(strict_types=1);

namespace MP\XID;

class Factory
{
    private const encodeTable = "0123456789abcdefghijklmnopqrstuv";

    public static function newXID(): string
    {
        $binary = static::getUniqueBinaryID();
        $asciiId = static::convertToAscii($binary);

        return static::buildXID($asciiId);
    }

    private static function getUniqueBinaryID(): string
    {
        return hex2bin((new \MongoDB\BSON\ObjectId())->__toString());
    }

    private static function convertToAscii(string $binary): array
    {
        $id = [];
        for ($i = 0; $i < strlen($binary); $i++) {
            $id[$i] = ord($binary[$i]);
        }

        return $id;
    }

    private static function buildXID(array $id): string
    {
        $xid = "";
        $xid[0] = self::encodeTable[$id[0] >> 3];
        $xid[1] = self::encodeTable[($id[1] >> 6) & 0x1F | ($id[0] << 2) & 0x1F];
        $xid[2] = self::encodeTable[($id[1] >> 1) & 0x1F];
        $xid[3] = self::encodeTable[($id[2] >> 4) & 0x1F | ($id[1] << 4) & 0x1F];
        $xid[4] = self::encodeTable[$id[3] >> 7 | ($id[2] << 1) & 0x1F];
        $xid[5] = self::encodeTable[($id[3] >> 2) & 0x1F];
        $xid[6] = self::encodeTable[$id[4] >> 5 | ($id[3] << 3) & 0x1F];
        $xid[7] = self::encodeTable[$id[4] & 0x1F];
        $xid[8] = self::encodeTable[$id[5] >> 3];
        $xid[9] = self::encodeTable[($id[6] >> 6) & 0x1F | ($id[5] << 2) & 0x1F];
        $xid[10] = self::encodeTable[($id[6] >> 1) & 0x1F];
        $xid[11] = self::encodeTable[($id[7] >> 4) & 0x1F | ($id[6] << 4) & 0x1F];
        $xid[12] = self::encodeTable[$id[8] >> 7 | ($id[7] << 1) & 0x1F];
        $xid[13] = self::encodeTable[($id[8] >> 2) & 0x1F];
        $xid[14] = self::encodeTable[($id[9] >> 5) | ($id[8] << 3) & 0x1F];
        $xid[15] = self::encodeTable[$id[9] & 0x1F];
        $xid[16] = self::encodeTable[$id[10] >> 3];
        $xid[17] = self::encodeTable[($id[11] >> 6) & 0x1F | ($id[10] << 2) & 0x1F];
        $xid[18] = self::encodeTable[($id[11] >> 1) & 0x1F];
        $xid[19] = self::encodeTable[($id[11] << 4) & 0x1F];

        return $xid;
    }
}
