<?php

class Guide
{
    public static function getAll()
    {
        $db = getDB();
        $stmt = $db->query("
            SELECT gp.*, u.name, u.email 
            FROM guide_profiles gp
            LEFT JOIN users u ON gp.user_id = u.id
            ORDER BY gp.created_at DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function existsByUserId($userId)
    {
        $db = getDB();
        $stmt = $db->prepare("SELECT COUNT(*) FROM guide_profiles WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn() > 0;
    }

    public static function create($data)
    {
        $db = getDB();
        
        $certificate = $data['certificate'] ?? null;
        if (!$certificate) {
            $certificate = json_encode([]);
        } elseif (!json_decode($certificate)) {
            $certificate = json_encode([$certificate]);
        }
        
        $languages = $data['languages'] ?? null;
        if (!$languages) {
            $languages = json_encode([]);
        } elseif (!json_decode($languages)) {
            $languages = json_encode(array_map('trim', explode(',', $languages)));
        }
        
        $stmt = $db->prepare("
            INSERT INTO guide_profiles (user_id, birthdate, phone, certificate, languages, 
                                       experience, rating, health_status, group_type, speciality, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        return $stmt->execute([
            $data['user_id'] ?? null,
            $data['birthdate'] ?? null,
            $data['phone'] ?? null,
            $certificate,
            $languages,
            $data['experience'] ?? null,
            $data['rating'] ?? null,
            $data['health_status'] ?? null,
            $data['group_type'] ?? null,
            $data['speciality'] ?? null
        ]);
    }

    public static function delete($id)
    {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM guide_profiles WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
