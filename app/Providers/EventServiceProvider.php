<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Models\Company;
use App\Observers\CompanyObserver;
use App\Models\Candidate;
use App\Observers\CandidateObserver;
use App\Models\JobActivity;
use App\Observers\JobActivityObserver;
use App\Models\JobTeamInvite;
use App\Observers\JobTeamInviteObserver;
use App\Models\Workflow;
use App\Observers\WorkflowObserver;
use App\Models\WorkflowStep;
use App\Observers\WorkflowStepObserver;
use App\Models\Specialization;
use App\Observers\SpecializationObserver;
use App\Models\CompanyFolder;
use App\Observers\CompanyFolderObserver;
use App\Models\FolderContent;
use App\Observers\FolderContentObserver;
use App\Models\AtsRequest;
use App\Observers\AtsRequestObserver;
use App\User;
use App\Observers\UserObserver;
use App\Models\Message;
use App\Observers\MessageObserver;
use App\Models\Order;
use App\Observers\OrderObserver;
use App\Models\Transaction;
use App\Observers\TransactionObserver;
use App\Models\VideoApplicationValues;
use App\Observers\VideoApplicationValuesObserver;
use App\Models\Job;
use App\Observers\JobObserver;
use App\Models\Interview;
use App\Observers\InterviewObserver;
use App\Models\InterviewNoteValues;
use App\Observers\InterviewNoteValuesObserver;
use App\Models\InterviewNoteOptions;
use App\Observers\InterviewNoteOptionsObserver;
use App\Models\OrderItem;
use App\Observers\OrderItemObserver;
use App\Models\TestRequest;
use App\Observers\TestRequestObserver;
use App\Models\FormFields;
use App\Observers\FormFieldsObserver;
use App\Models\FormFieldValues;
use App\Observers\FormFieldValuesObserver;
use App\Models\Role;
use App\Observers\RoleObserver;
use App\Models\InterviewNotes;
use App\Observers\InterviewNotesObserver;
use App\Models\InterviewNoteTemplates;
use App\Observers\InterviewNoteTemplatesObserver;
use App\Models\Cv;
use App\Observers\CvObserver;
use App\Models\JobApplication;
use App\Observers\JobApplicationObserver;
use App\Models\JobApplicationMessage;
use App\Observers\JobApplicationMessageObserver;
use App\Models\Invoices;
use App\Observers\InvoicesObserver;
use App\Models\InvoiceItems;
use App\Observers\InvoiceItemsObserver;




class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
        'Illuminate\Auth\Events\Login' => ['App\Listeners\LoginSuccessful'],
        
        'Illuminate\Auth\Events\PasswordReset' => [
            'App\Listeners\LogPasswordReset',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Company::observe(CompanyObserver::class);
        Candidate::observe(CandidateObserver::class);
        JobActivity::observe(JobActivityObserver::class);
        JobTeamInvite::observe(JobTeamInviteObserver::class);
        Workflow::observe(WorkflowObserver::class);
        WorkflowStep::observe(WorkflowStepObserver::class);
        Specialization::observe(SpecializationObserver::class);
        CompanyFolder::observe(CompanyFolderObserver::class);
        FolderContent::observe(FolderContentObserver::class);
        AtsRequest::observe(AtsRequestObserver::class);
        User::observe(UserObserver::class);
        Message::observe(MessageObserver::class);
        TestRequest::observe(TestRequestObserver::class);
        Order::observe(OrderObserver::class);
        Transaction::observe(TransactionObserver::class);
        VideoApplicationValues::observe(VideoApplicationValuesObserver::class);
        Job::observe(JobObserver::class);
        Interview::observe(InterviewObserver::class);
        InterviewNoteValues::observe(InterviewNoteValuesObserver::class);
        InterviewNoteOptions::observe(InterviewNoteOptionsObserver::class);
        OrderItem::observe(OrderItemObserver::class);
        Invoices::observe(InvoicesObserver::class);
        InvoiceItems::observe(InvoiceItemsObserver::class);
        FormFields::observe(FormFieldsObserver::class);
        FormFieldValues::observe(FormFieldValuesObserver::class);
        Role::observe(RoleObserver::class);
        InterviewNotes::observe(InterviewNotesObserver::class);
        InterviewNoteTemplates::observe(InterviewNoteTemplatesObserver::class);
        Cv::observe(CvObserver::class);
        JobApplication::observe(JobApplicationObserver::class);
        JobApplicationMessage::observe(JobApplicationMessageObserver::class);


        //
    }
}
