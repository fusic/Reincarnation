# Reincarnation

[![Build Status](https://travis-ci.org/fusic/Reincarnation.svg?branch=master)](https://travis-ci.org/fusic/Reincarnation)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/fusic/Reincarnation/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/fusic/Reincarnation/?branch=master)

CakePHP3用論理削除プラグインです。

# Usage

## Model/Table

```php
class UsersTable extends Table
{
    public function initialize(array $config)
    {
        // default case
        $this->addBehavior('Reincarnation.SoftDelete');
        - field name
          - deleted(boolean)
          - delete_date(timestamp)

        // field custom case
        $this->addBehavior('Reincarnation.SoftDelete', ['boolean' => delete_flg, 'timestamp' => 'deleted']);
        - field name
          - delete_flg(boolean)
          - deleted(timestamp)

        // boolean only case
        $this->addBehavior('Reincarnation.SoftDelete', ['boolean' => delete_flg, 'timestamp' => false]);
        - field name
          - delete_flg(boolean)

        // timestamp only case
        $this->addBehavior('Reincarnation.SoftDelete', ['boolean' => false, 'timestamp' => 'deleted']);
        - field name
          - deleted(timestamp)
    }
}
```

## Controller

```php
class UsersController extends AppController
{
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->softDelete($user)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please, try again.'));
        }
        return $this->redirect('action' => 'index');
    }
}
```


