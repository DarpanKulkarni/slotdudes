<?php

namespace App\Backup\Cleanup;

use Spatie\Backup\BackupDestination\BackupCollection;
use Spatie\Backup\Tasks\Cleanup\CleanupStrategy;

class KeepLatestTwoBackups extends CleanupStrategy
{
    public function deleteOldBackups(BackupCollection $backups): void
    {
        // Since the collection is sorted by age (latest first),
        // we want to keep the first 2 and delete the rest

        if ($backups->count() <= 2) {
            // If we have 2 or fewer backups, keep them all
            return;
        }

        // Get all backups except the first 2 (latest)
        $backupsToDelete = $backups->skip(2);

        // Delete each old backup
        $backupsToDelete->each(function ($backup) {
            $backup->delete();
        });
    }
}
