<?php

return [
    'updated'                                 => ':name has been updated successfully.',
    'update_failed'                           => 'Failed to update :name.',
    'activity_description'                    => ':name of same type is not allowed to be added.',
    'participating_org'                       => 'There should be at least one :name with the role "Funding" or "Implementing".',
    'created'                                 => ':name has been created successfully.',
    'save_failed'                             => 'Failed to save :name.',
    'deleted'                                 => ':name has been deleted successfully.',
    'delete_failed'                           => 'Failed to delete :name.',
    'settings'                                => 'Please fill up Reporting Organisation Identifier to add :name.',
    'default_values'                          => 'Please fill up default values to add :name',
    'default_field_groups_required'           => 'Please check required fields to add :name',
    'activity_statuses'                       => 'Activity has been :name.',
    'activity_statuses_failed'                => 'Activity cannot be :name.',
    'org_statuses'                            => 'Organisation has been :name.',
    'org_statuses_failed'                     => 'Organisation cannot be :name.',
    'settings_registry_info'                  => 'Please fill up Publisher Id & Api Id to publish.',
    'publish_registry'                        => 'Could not publish to registry. Try Again.',
    'publish_registry_publish'                => 'Activity has been Published.',
    'publish_registry_organization'           => 'Organization data  has been Published.',
    'update_registry_publish'                 => 'Activity could not be updated.',
    'upgraded'                                => 'Version upgraded to :version.',
    'upgrade_failed'                          => 'Failed to upgrade. Try Again.',
    'transfer_message'                        => 'Deleted Successfully',
    'duplicated'                              => 'Activity has been duplicated successfully.View duplicated <a href=":url">Activity</a>',
    'duplication_failed'                      => 'Failed to duplicate the activity.',
    'password_mismatch'                       => 'Current Password doesn\'t match with the entered :name.',
    'empty_template'                          => 'You have uploaded empty :name template.Please upload the template with data.',
    'header_mismatch'                         => 'The header doesn\'t matched with the provided template. Please Check the headers.',
    'message'                                 => ':message',
    'not_uploaded'                            => 'Some invalid activities (at row(s): :invalidRows) did not get saved while the valid ones (at row(s): :rows) have been saved.',
    'recipient_region_unselected_in_settings' => 'Recipient Region is not selected in Settings.Please empty this field.',
    'csv_template_error'                      => 'The CSV file you uploaded does not match with the Activity Template. Please download Activity template from below.',
    'activity_element_removed'                => 'Activity element has been removed successfully.',
    'activity_element_not_removed'            => 'Failed to remove activity element.',
    'transaction_block_removed'               => 'The block from Transaction has been removed successfully.',
    'transaction_block_not_removed'           => 'Failed to remove the block from Transaction.',
    'activity_imported'                       => sprintf('One Activity %s has been imported successfully.', ':activities'),
    'activities_imported'                     => sprintf('Activities %s have been imported successfully.', ':activities'),
    'activities_import_failed'                => 'Failed to import activities.',
    'failed_registration'                     => 'Failed to complete registration.',
    'registered'                              => 'Your organisation has been registered successfully. Shortly, all the user you have listed will receive verification emails.',
    'sent'                                    => ':name have been sent',
    'organization_element_removed'            => 'Organisation element has been removed successfully',
    'organization_element_not_removed'        => 'Failed to remove organisation element',
    'user_created'                            => 'The user account with :name, has been created successfully. Please notify the user their username and password to start using their AidStream account.',
    'csv_header_mismatch'                     => ':message',
    'settings_incomplete'                     => 'Please fill up all the required fields before creating an activity.',
    'encoding_error'                          => 'It seems the file you have uploaded is not in UTF-8 encoding standard. If you didn\'t get accurate result, please change the file into UTF-8 encoding standard and try again.',
    'published_not_linked'                    => "You have set automatic update to publish to No in <a href='/publishing-settings'>settings</a>. The activity has been published to AidStream but not linked to the IATI Registry. Please re-publish the activity from <a href='/list-published-files'>here.</a>",
    'organization_published_not_linked'       => "You have set automatic update to publish to No in <a href='/publishing-settings'>settings</a>. The organization data has been published to AidStream but not linked to the IATI Registry. Please re-publish the organization data from <a href='/list-published-files'>here.</a>",
    'cannot_delete_reporting_org'             => 'Cannot delete reporting organisation',
    'cannot_delete_published_org'             => 'You cannot delete a published :name.',
    'budget_not_provided'                     => 'Budget Not Provided has been set in Activity Defaults. Please remove the field from <a href=":link">here</a> to add a new Budget',
    'budget_not_provided_activity_default'    => 'Budget has been set in Activity Data. You need to delete budget to add \'Budget Not Provided\''
];
