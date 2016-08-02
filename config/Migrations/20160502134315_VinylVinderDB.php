<?php
use Migrations\AbstractMigration;

class VinylVinderDB extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('comments');
        $table
            ->addColumn('thread_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('author_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created_at', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('updated_at', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('body', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('deleted', 'integer', [
                'default' => 0,
                'limit' => 4,
                'null' => false,
            ])
            ->addIndex(
                [
                    'author_id',
                ]
            )
            ->addIndex(
                [
                    'thread_id',
                ]
            )
            ->create();

        $table = $this->table('forums');
        $table
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('description', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('min_permission', 'string', [
                'default' => 'forums_index',
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('section_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addIndex(
                [
                    'section_id',
                ]
            )
            ->addIndex(
                [
                    'min_permission',
                ]
            )
            ->create();

        $table = $this->table('permissions');
        $table
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => 16777215,
                'null' => false,
            ])
            ->addIndex(
                [
                    'name',
                ],
                ['unique' => true]
            )
            ->create();

        $table = $this->table('permissions_roles', ['id' => false, 'primary_key' => ['role_id', 'permission_id']]);
        $table
            ->addColumn('role_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('permission_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addIndex(
                [
                    'permission_id',
                ]
            )
            ->addIndex(
                [
                    'role_id',
                ]
            )
            ->create();

        $table = $this->table('reports');
        $table
            ->addColumn('handled', 'boolean', [
                'default' => 0,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('handled_by', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('reported_by', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('thread_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('comment_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('reason', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $table = $this->table('roles');
        $table
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('edit_protect', 'boolean', [
                'default' => 1,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('delete_protect', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => 16777215,
                'null' => true,
            ])
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('banned', 'boolean', [
                'default' => 0,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('post_delay', 'integer', [
                'default' => 30,
                'limit' => 3,
                'null' => false,
            ])
            ->create();

        $table = $this->table('roles_users', ['id' => false, 'primary_key' => ['user_id', 'role_id']]);
        $table
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('role_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addIndex(
                [
                    'role_id',
                ]
            )
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->addIndex(
                [
                    'user_id',
                    'role_id',
                ]
            )
            ->create();

        $table = $this->table('sections');
        $table
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('description', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('min_role', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addIndex(
                [
                    'min_role',
                ]
            )
            ->create();

        $table = $this->table('subforums');
        $table
            ->addColumn('parent_forum', 'integer', [
                'default' => 0,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('min_permission', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('description', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'parent_forum',
                ]
            )
            ->create();

        $table = $this->table('threads');
        $table
            ->addColumn('forum_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('author_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('lastposter_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('lastpost_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('edit_by', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('closed', 'integer', [
                'default' => 0,
                'limit' => 4,
                'null' => false,
            ])
            ->addColumn('subforum_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('slug', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('body', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'author_id',
                ]
            )
            ->addIndex(
                [
                    'edit_by',
                ]
            )
            ->addIndex(
                [
                    'forum_id',
                ]
            )
            ->addIndex(
                [
                    'lastposter_id',
                ]
            )
            ->addIndex(
                [
                    'subforum_id',
                ]
            )
            ->create();

        $table = $this->table('user_preferences', ['id' => false, 'primary_key' => ['id', 'user_id']]);
        $table
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('show_email', 'boolean', [
                'default' => 0,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('receive_pms', 'boolean', [
                'default' => 0,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('year', 'integer', [
                'default' => 0,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('month', 'integer', [
                'default' => 0,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('day', 'integer', [
                'default' => 0,
                'limit' => 11,
                'null' => false,
            ])
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->create();

        $table = $this->table('users');
        $table
            ->addColumn('username', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('avatar', 'string', [
                'default' => 'default-avatar.png',
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('primary_role', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('created_at', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('updatd_at', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('autograph', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'primary_role',
                ]
            )
            ->create();

        $table = $this->table('warnings');
        $table
            ->addColumn('reason', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('percentage', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created_at', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('expires', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('warned_user', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('warned_by', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('expired', 'integer', [
                'default' => 0,
                'limit' => 4,
                'null' => false,
            ])
            ->create();

        $this->table('comments')
            ->addForeignKey(
                'author_id',
                'users',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'thread_id',
                'threads',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('forums')
            ->addForeignKey(
                'section_id',
                'sections',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('permissions_roles')
            ->addForeignKey(
                'permission_id',
                'permissions',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'role_id',
                'roles',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('roles_users')
            ->addForeignKey(
                'role_id',
                'roles',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('sections')
            ->addForeignKey(
                'min_role',
                'roles',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('subforums')
            ->addForeignKey(
                'parent_forum',
                'forums',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('threads')
            ->addForeignKey(
                'author_id',
                'users',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'edit_by',
                'users',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'forum_id',
                'forums',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'lastposter_id',
                'users',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('user_preferences')
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('users')
            ->addForeignKey(
                'primary_role',
                'roles',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

    }

    public function down()
    {
        $this->table('comments')
            ->dropForeignKey(
                'author_id'
            )
            ->dropForeignKey(
                'thread_id'
            );

        $this->table('forums')
            ->dropForeignKey(
                'section_id'
            );

        $this->table('permissions_roles')
            ->dropForeignKey(
                'permission_id'
            )
            ->dropForeignKey(
                'role_id'
            );

        $this->table('roles_users')
            ->dropForeignKey(
                'role_id'
            )
            ->dropForeignKey(
                'user_id'
            );

        $this->table('sections')
            ->dropForeignKey(
                'min_role'
            );

        $this->table('subforums')
            ->dropForeignKey(
                'parent_forum'
            );

        $this->table('threads')
            ->dropForeignKey(
                'author_id'
            )
            ->dropForeignKey(
                'edit_by'
            )
            ->dropForeignKey(
                'forum_id'
            )
            ->dropForeignKey(
                'lastposter_id'
            );

        $this->table('user_preferences')
            ->dropForeignKey(
                'user_id'
            );

        $this->table('users')
            ->dropForeignKey(
                'primary_role'
            );

        $this->dropTable('comments');
        $this->dropTable('forums');
        $this->dropTable('permissions');
        $this->dropTable('permissions_roles');
        $this->dropTable('reports');
        $this->dropTable('roles');
        $this->dropTable('roles_users');
        $this->dropTable('sections');
        $this->dropTable('subforums');
        $this->dropTable('threads');
        $this->dropTable('user_preferences');
        $this->dropTable('users');
        $this->dropTable('warnings');
    }
}
