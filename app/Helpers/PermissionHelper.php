<?php

namespace App\Helpers;

class PermissionHelper {
    /**
     * Role Permissions Matrix
     */
    private static $matrix = [
        'super_admin' => ['articles.full', 'media.full', 'settings', 'users'],
        'editor'      => ['articles.full', 'media.full', 'comments.approve'],
        'author'      => ['articles.own', 'media.upload'],
        'reporter'    => ['articles.own_draft'],
        'translator'  => ['articles.translations'],
    ];

    /**
     * Check if a role can perform an action
     */
    public static function can(string $role, string $permission): bool {
        if (!isset(self::$matrix[$role])) return false;
        
        $perms = self::$matrix[$role];
        
        // Super admin has all powers
        if ($role === 'super_admin') return true;

        return in_array($permission, $perms);
    }

    /**
     * Check access to a specific URI path
     */
    public static function canAccess(string $role, string $uri): bool {
        if ($role === 'super_admin') return true;

        if (str_contains($uri, '/admin/settings') || str_contains($uri, '/admin/users')) {
            return $role === 'super_admin';
        }

        if (str_contains($uri, '/admin/articles/delete')) {
            return in_array($role, ['super_admin', 'editor']);
        }

        return true;
    }
}
