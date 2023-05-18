<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'departments' => [
        'name' => 'Departments',
        'index_title' => 'Departments List',
        'new_title' => 'New Department',
        'create_title' => 'Create Department',
        'edit_title' => 'Edit Department',
        'show_title' => 'Show Department',
        'inputs' => [],
    ],

    'participants' => [
        'name' => 'Participants',
        'index_title' => 'Participants List',
        'new_title' => 'New Participant',
        'create_title' => 'Create Participant',
        'edit_title' => 'Edit Participant',
        'show_title' => 'Show Participant',
        'inputs' => [],
    ],

    'programs' => [
        'name' => 'Programs',
        'index_title' => 'Programs List',
        'new_title' => 'New Program',
        'create_title' => 'Create Program',
        'edit_title' => 'Edit Program',
        'show_title' => 'Show Program',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'announcements' => [
        'name' => 'Announcements',
        'index_title' => 'Announcements List',
        'new_title' => 'New Announcement',
        'create_title' => 'Create Announcement',
        'edit_title' => 'Edit Announcement',
        'show_title' => 'Show Announcement',
        'inputs' => [
            'title' => 'Title',
            'description' => 'Description',
            'image_path' => 'Image Path',
            'file_path' => 'File Path',
        ],
    ],

    'checks' => [
        'name' => 'Checks',
        'index_title' => 'Checks List',
        'new_title' => 'New Check',
        'create_title' => 'Create Check',
        'edit_title' => 'Edit Check',
        'show_title' => 'Show Check',
        'inputs' => [
            'program_id' => 'Program',
            'counter_id' => 'Counter',
            'staff_id' => 'Staff',
            'participant_id' => 'Participant',
            'isCheckIn' => 'Is Check In',
        ],
    ],

    'counters' => [
        'name' => 'Counters',
        'index_title' => 'Counters List',
        'new_title' => 'New Counter',
        'create_title' => 'Create Counter',
        'edit_title' => 'Edit Counter',
        'show_title' => 'Show Counter',
        'inputs' => [
            'program_id' => 'Program',
            'name' => 'Name',
            'isCheckIn' => 'Is Check In',
        ],
    ],

    'feedbacks' => [
        'name' => 'Feedbacks',
        'index_title' => 'Feedbacks List',
        'new_title' => 'New Feedback',
        'create_title' => 'Create Feedback',
        'edit_title' => 'Edit Feedback',
        'show_title' => 'Show Feedback',
        'inputs' => [
            'program_id' => 'Program',
            'participant_id' => 'Participant',
            'comment' => 'Comment',
            'rating' => 'Rating',
            'feedback_photo_path' => 'Feedback Photo Path',
        ],
    ],

    'manual_payments' => [
        'name' => 'Manual Payments',
        'index_title' => 'ManualPayments List',
        'new_title' => 'New Manual payment',
        'create_title' => 'Create ManualPayment',
        'edit_title' => 'Edit ManualPayment',
        'show_title' => 'Show ManualPayment',
        'inputs' => [
            'file_path' => 'File Path',
            'remarks' => 'Remarks',
            'payment_method' => 'Payment Method',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'ic_no' => 'Ic No',
            'dob' => 'Dob',
            'gender_id' => 'Gender',
            'age' => 'Age',
            'phone_no' => 'Phone No',
            'world_city_id' => 'World City Id',
            'world_division_id' => 'World Division Id',
        ],
    ],

    'transactions' => [
        'name' => 'Transactions',
        'index_title' => 'Transactions List',
        'new_title' => 'New Transaction',
        'create_title' => 'Create Transaction',
        'edit_title' => 'Edit Transaction',
        'show_title' => 'Show Transaction',
        'inputs' => [
            'user_id' => 'User',
            'amount' => 'Amount',
            'transactionable_id' => 'Transactionable Id',
            'transactionable_type' => 'Transactionable Type',
        ],
    ],

    'stations' => [
        'name' => 'Stations',
        'index_title' => 'Stations List',
        'new_title' => 'New Station',
        'create_title' => 'Create Station',
        'edit_title' => 'Edit Station',
        'show_title' => 'Show Station',
        'inputs' => [
            'name' => 'Name',
            'world_city_id' => 'World City Id',
            'world_division_id' => 'World Division Id',
        ],
    ],

    'all_staff' => [
        'name' => 'All Staff',
        'index_title' => 'AllStaff List',
        'new_title' => 'New Staff',
        'create_title' => 'Create Staff',
        'edit_title' => 'Edit Staff',
        'show_title' => 'Show Staff',
        'inputs' => [
            'user_id' => 'User',
            'station_id' => 'Station',
            'department_id' => 'Department',
            'referral_code' => 'Referral Code',
        ],
    ],

    'organizers' => [
        'name' => 'Organizers',
        'index_title' => 'Organizers List',
        'new_title' => 'New Organizer',
        'create_title' => 'Create Organizer',
        'edit_title' => 'Edit Organizer',
        'show_title' => 'Show Organizer',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'online_payments' => [
        'name' => 'Online Payments',
        'index_title' => 'OnlinePayments List',
        'new_title' => 'New Online payment',
        'create_title' => 'Create OnlinePayment',
        'edit_title' => 'Edit OnlinePayment',
        'show_title' => 'Show OnlinePayment',
        'inputs' => [],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
