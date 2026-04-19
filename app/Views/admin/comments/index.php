<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<div class="card">
    <div class="card-header">
        <h3 style="font-size: 16px;">Reader Comments</h3>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Comment</th>
                    <th>Article</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div style="font-weight: 600;">Gurpreet Singh</div>
                        <div style="font-size: 12px; color: var(--text-muted);">gurpreet@example.com</div>
                    </td>
                    <td><p style="max-width:300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">This is a very important update for all farmers. Thank you for sharing.</p></td>
                    <td>Farmer Protest Updates</td>
                    <td>Oct 20, 2023</td>
                    <td><span class="badge badge-warning">Pending</span></td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <button class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;">Approve</button>
                            <button class="btn" style="padding: 6px; background: rgba(239, 68, 68, 0.1); color: #ef4444;"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="font-weight: 600;">Anjali Sharma</div>
                        <div style="font-size: 12px; color: var(--text-muted);">anjali@example.com</div>
                    </td>
                    <td><p style="max-width:300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Great coverage of the event!</p></td>
                    <td>Ludhiana Cultural Festival</td>
                    <td>Oct 19, 2023</td>
                    <td><span class="badge badge-success">Approved</span></td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <button class="btn" style="padding: 6px; background: rgba(239, 68, 68, 0.1); color: #ef4444;"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
