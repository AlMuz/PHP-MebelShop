<div class="user index large-9 medium-8 columns content">
    <h3><?= __('User') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('idUser') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Login') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Password') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Surname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Phonenumber') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Root') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->idUser) ?></td>
                <td><?= h($user->Login) ?></td>
                <td><?= h($user->Password) ?></td>
                <td><?= h($user->Email) ?></td>
                <td><?= h($user->Name) ?></td>
                <td><?= h($user->Surname) ?></td>
                <td><?= $this->Number->format($user->Phonenumber) ?></td>
                <td><?= h($user->Date) ?></td>
                <td><?= $this->Number->format($user->Root) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->idUser]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->idUser]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->idUser], ['confirm' => __('Are you sure you want to delete # {0}?', $user->idUser)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
