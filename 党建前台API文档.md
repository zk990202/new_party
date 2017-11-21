# 党建前台API文档(可能有点乱，但是我相信前端看得懂！)

## 一、前台首页

### 1.顶层栏目--路由

(1)首页：/api/index

(2)网上党校：申请人培训：/api/applicant/course

​			院级积极分子培训：/api/academy/course

​			预备党员培训：/api/probationary/notice

(3)通知公告：党校公告：/api/notice/party-school/list/applicant

​			活动通知：/api/notice/activity/list

(4)党建专项：/api/party-build/list

(5)党校培训：/api/party-school/list

(6)重要文件：/api/important-file/list

(7)理论学习：/api/

(8)支部风采：/api/

### 2.最新通知

(1)路由：/api/notice/{id}/detail

(2)页面参数：notice-->id：链接的id；   

​				title：显示的标题

###3.党建专项

(1)路由：/api/party-build/{id}/detail

(2)页面参数：partyBuild{	id：链接的id；

 					title：显示的标题	}

### 4.支部风采

(1)路由：/api/branch-activity/{id}/detail

(2)页面参数：branchActivity{	id：链接的id；

​					      	name：显示的支部名称	}

### 5.榜样力量

### 6.党校培训

(1)路由：/api/party-school/{id}/detail

(2)页面参数：partySchool{		id：链接的id；

​					  	title：显示的标题	   }

###7.网上党课(图片链接)

路由：/api/theory-study/list

### 8.影像课程(图片链接)

路由：/api/theory-study/movie-list

##二、通知公告

### 1.申请人培训

左侧栏路由：/api/notice/party-school/list/applicant

### 2.院级积极分子培训

左侧栏路由：/api/notice/party-school/list/academy

### 3.预备党员培训

左侧栏路由：/api/notice/party-school/list/probationary

### 4.党支部书记培训

左侧栏路由：/api/notice/party-school/list/secretary

### 5.活动通知

左侧栏路由：/api/notice/activity/list

### 6.每个子栏目下的页面(列出一页通知)

(1)进入通知详情的路由：/api/notice/{notice_id}/detail

(2)json参数：notice { 	data{	notice_id：链接的通知id

​						notice_title：通知标题		

​						}

​				current_page：当前页数

​				last_page：最后一页

​				next_page_url：下一页的url

​				total：总数据条数

​			    }

### 7.通知详情

(1)路由：/api/notice/{notice_id}/detail（其中notice_id即为6(2)中的notice_id）

(2)json参数：notice{	title：通知标题

​				authorName：发起者

​				content：通知内容

​				fileName：附件名称

​				filePath：附件路径

​				}



## 三、网上党校

###1.申请人培训

#### 课程学习

(1)路由：/api/applicant/course

(2)json参数：course{	id：课程的id

​				courseName：课程名称

​				}	

(3)点击课程进入对应的几篇文章：/api/applicant/{course_id}/course（此处course_id为(2)中id）

​				       json参数：article{  id：文章id

​									}

(4)点击文章进入文章详情：/api/applicant/{article_id}/article（此处article_id为(3)中的id）

​					json参数：article{  articleName：文章名称

​									  courseName：文章所属的课程

​									  content：文章内容

​									}

(5)章节考试：/api/applicant/{course_id}/exercise（此处course_id为(2)中id）   GET方法

​     json参数：exercise{ courseName：考试对应的课程

​					 content：题目题干

​					 optionA~optionE：答案A~E

​					 answerLetter：正确答案

​					}

​    提交考试结果：/api/applicant/{course_id}/exercise（此处course_id为(2)中id）   POST方法

​      