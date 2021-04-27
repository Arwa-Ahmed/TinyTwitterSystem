<?php


namespace App\Services;


use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\TweetRepositoryInterface;
use App\Services\PDF\Contracts\PdfServiceInterface;

class ReportService
{
    protected $userRepositoryInterface;
    protected $tweetRepositoryInterface;
    protected $pdfServiceInterface;
    public function __construct(UserRepositoryInterface $userRepositoryInterface , PdfServiceInterface $pdfServiceInterface,TweetRepositoryInterface $tweetRepositoryInterface){
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->pdfServiceInterface = $pdfServiceInterface;
        $this->tweetRepositoryInterface = $tweetRepositoryInterface;
    }

    public function UsersReport(){
        //get data
        $users = $this->userRepositoryInterface->getAllUser();
        $totalTweets = $this->tweetRepositoryInterface->getAllTweets()->count();
        //Average Number Tweets Per user
        $averageNumberOfTweets = $totalTweets/$users->count();
        $data = ['users'=>$users,'totalTweets'=>$totalTweets,'averageNumberOfTweets'=>$averageNumberOfTweets];
        //generate pdf
        $pdf = $this->pdfServiceInterface->generatePdf('UsersPdfReport', $data);

        return $pdf;
    }

}
