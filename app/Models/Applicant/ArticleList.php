<?php

namespace App\Models\Applicant;

use App\Http\Helpers\Resources;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ArticleList
 * 入党申请人学习文章
 * @package App\Models\Applicant
 */

class ArticleList extends Model
{
    //
    protected $table = 'twt_applicant_articlelist';
    protected $primaryKey = 'article_id';

    //创建时间字段
    const CREATED_AT = 'created_at';

    protected $fillable = ['course_id', 'article_name', 'article_content', 'article_ishidden', 'article_isdeleted'];

    /**
     * 模型的「启动」方法
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('notDeleted', function(Builder $builder) {
            $builder->where('article_isdeleted', 0);
        });
    }

    public function courseList(){
        return $this->belongsTo('App\Models\Applicant\CourseList', 'course_id','course_id');
    }

    /**
     * 获取所有文章
     * @return array
     */
    public static function getAll(){
        $res_arr = self::orderBy('course_id', 'ASC')
            ->get()->all();
        return array_map(function ($articleList){
            return Resources::ArticleList($articleList);
        }, $res_arr);
    }

    /**
     * 根据课程id获取文章
     * @param $id
     * @return array
     */
    public static function getArticleByCourseId($id){
        $articles = self::where('course_id', $id)
            ->get()->all();
        return array_map(function ($article){
            return Resources::ArticleList($article);
        }, $articles);
    }

    /**
     * 根据文章id获取一篇文章的信息
     * @param $id
     * @return array
     */
    public static function getOneArticle($id){
        $res = self::where('article_id', $id)
            ->get()->all();
        return array_map(function ($articleList){
            return Resources::ArticleList($articleList);
        }, $res);
    }

    /**
     * 更新文章
     * @param $id
     * @param $data
     * @return array|bool
     */
    public static function updateById($id, $data){
        $article = self::findOrFail($id);
        $article->article_name = $data['articleName'];
        $article->course_id = $data['courseId'];
        $article->article_content = $data['content'];
        $res = $article->save();
        return $res ? Resources::ArticleList($article) : false;
    }

    /**
     * 根据课程id添加文章
     * @param $course_id
     * @param $data
     * @return array|bool
     */
    public static function add($course_id, $data){
        $article = self::create([
            'course_id' => $course_id,
            'article_name' => $data['articleName'],
            'article_content' => $data['content'],
            'article_ishidden' => 0,
            'article_isdeleted' => 0
        ]);
        return $article ? Resources::ArticleList($article) : false;
    }
}
