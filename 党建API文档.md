# 党建API文档

#一、首页

````json
/api/index [GET]
首页
参数列表:
token // 可选参数
返回的json
{
    "success": 1, // 请求成功
    "partyBuild": [ // 数组，包含全部返回的党建专项内容
        {
            "id": 267, // 文章id
            "title": "习近平：作风建设要经常抓深入抓持久抓  不断巩固扩大教育实践活动成果", // 文章标题
            "summary": "" // 文章简介
            "content": "<p>来源：人民日报<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 5月9日，中共中央总书记、国家主席、中央军委主席习近平到党的群众路线教育实践活动联系点河南省兰考县，指导兰考县委常委班子专题民主生活会并发表重要讲话。<br />......", // 文章内容
            "time": { 
                "date": "2014-05-20 15:32:29.000000", // 文章创建时间
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "authorName": "韩光耀", // 文章的作者
            "type": 81, // 所属类别id
            "typeName": "群众路线", //所属类别
            "isTop": 1, // 是否置顶
            "imgPath": "./upload/images/9a38e8ca53921c865317216a58fbc8b6.jpg", // 图片路径
            "isHidden": 0 // 是否隐藏
        }
     ]
    "notice": [ // 数组，包含全部返回的通知公告内容
        {
            "id": 323, // 通知id
            "columnId": 70, // 所属类型id
            "columnName": "申请人党校", // 所属类型
            "title": "第五十三期入党申请人培训结业考试成绩查询通知" // 通知标题
            "time": {
                "date": "2017-05-21 22:27:07.000000", // 通知添加时间
                "timezone_type": 3,
                "timezone": "UTC"
            }
        }
    ]
    "partySchool": [ // 数组，包含全部返回的党校培训内容
        {
            "id": 269, // 文章id
            "title": "小组展示现风采，培训结束情谊深", // 文章标题
            "summary": "记天津大学第十六期党支部书记培训班结业典礼", // 文章简介
            "content": "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 从初春的百花繁茂到如今的夏柳荫浓，经过为期四周的分散培训，天津大学党支部书记培训班已经悄然接近尾声。", //文章内容
            "time": {
                "date": "2014-05-20 15:39:50.000000", // 文章添加时间
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "authorName": "韩光耀", // 文章作者
            "type": 2, // 文章类型id
            "typeName": "活动通知", // 文章类型
            "isTop": 1, // 是否置顶
            "imgPath": null, // 图片路径
            "isHidden": 0 // 是否隐藏
        }
    ]
    "branchActivity": [ // 数组， 包含全部返回的支部风采的内容
        {
            "id": 2394, // 支部id
            "name": "材料学院级博士生高分子第一党支部",	// 支部名
            "secretary": "1015208041", // 支部书记学号
            "secretaryName": "", // 支部书记姓名
            "organizer": "1016208024", // 组织委员学号
            "organizerName": "", // 组织委员姓名
            "propagator": "1016208032", // 宣传委员学号
            "propagatorName": "", // 宣传委员姓名
            "academy": 8, // 学院id
            "academyName": "材料科学与工程学院", // 学院全称
            "academyShortName": "材料学院", // 学院简称
            "type": "3", // 支部类型
            "schoolYear": "", // 支部所属年纪
            "establishTime": {
                "date": "2017-05-25 17:54:14.000000", // 支部建立时间
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "isHidden": 0, // 是否隐藏
            "isDeleted": 0, // 是否删除
        }
    ]
    "mainStatus": 0 // 用户当前的入党状态
    "userInfo": { 
        "user_number": "3016218103", // 用户学号(工号)
        "twt_name": "zk990202", // 天外天账号
        "party_branch_id": 2388, // 所属支部
        "is_probationary": 1, // 是否是支书
        "is_teacher": 0, // 是否是老师
        "token":
 "FCq0rXnw70CrMURORG0FP19TIwGfNCeApGoGersIN8RQNSel7zlMPyn59pLtXNJzUN0VDuxVkDkaOqge9J8oCd5mzmESs0PWsNXr"
    }
}

接口正确返回都会有success字段，没有则说明请求失败，在message字段中返回原因
{
  "message": 'error message'
}
````

## 二、通知公告

````json
/api/notice/party-school/list/appicant [GET]
通知公告首页/申请人培训栏目
无参数
返回的json
{
  	"success": 1,
	"notice": {
	    "current_page": 1 // 当前页
	  	"data":[ // 数组， 包含全部的返回的内容
	    	{
	    		"notice_id": 323, // 通知id
	            "column_id": 70, // 所属类型id
	            "notice_title": "第五十三期入党申请人培训结业考试成绩查询通知", // 通知标题
			}
	  	]
  		"last_page": 25, // 最后一页
        "next_page_url": "http://127.0.0.1:1024/api/notice/party-school/list/applicant?page=2", // 下一页链接
        "path": "http://127.0.0.1:1024/api/notice/party-school/list/applicant",
        "per_page": 6, 
        "total": 150 // 总数据条数
    }
}

/api/notice/party-school/list/academy [GET]
院级积极分子培训栏目
无参数
返回的json与申请人培训栏目相同

/api/notice/party-school/list/probationary [GET]
预备党员培训栏目
无参数
返回的json与申请人培训栏目相同

/api/notice/party-school/list/secretary [GET]
党支部书记培训栏目
无参数
返回的json与申请人培训栏目相同

/api/notice/activity/list [GET]
活动通知栏目
无参数
返回的json与申请人培训栏目相同

/api/notice/{notice_id}/detail [GET]
每个栏目下的通知详情
参数列表:
notice_id // 通知id
返回的json
{
  	"success": 1,
    "notice": [ // 只有第一组数据的一个数组
        {
            "id": 231, // 通知id
            "columnId": 2, // 所属类别id
            "columnName": "活动通知", // 所属类别
            "title": "党建系统新功能", // 通知标题
            "content": "<p>点击头部右边的[设置]按钮,能够设置属于自己的党建系统样式和淡入效果.</p>", // 通知内容
            "time": {
                "date": "2013-11-10 21:18:06.000000", // 通知添加的时间
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "fileName": null, // 附件名
            "filePath": null, // 附件路径
            "authorName": "", // 通知作者
        }
    ]
}
接口正确返回都会有success字段，没有则说明请求失败，在message字段中返回原因
{
  "message": 'error message'
}
````

## 三、网上党校

###1.申请人培训

````json
/api/applicant/course [GET]
申请人培训首页/申请人培训下的课程学习
无参数
返回的json
{
  	"success": 1, // 请求成功
  	"course": [ // 数组， 返回20课
        {
            "id": 41, // 课程id
            "courseName": "第一课 近代革命史的起点", // 课程名
            "detail": "", // 课程详情
            "time": "2016-07-17 16:11:40", // 课程添加时间
        }
    ]
}

/api/applicant/{course_id}/course [GET]
课程对应的文章
参数列表:
course_id // 课程id
返回的json
{
    "success": 1,
    "article": [ // 数组， 返回该课程对应的所有文章
        {
            "id": 282, // 文章id
            "courseId": 41, // 所属课程id
            "articleName": "近代中华民族的历史任务和辛亥革命", // 文章名
            "courseName": "第一课 近代革命史的起点", // 所属课程名
        }
    ]
}

/api/applicant/{article_id}/article [GET]
文章详情
参数列表:
article_id // 文章id
返回的json
{
    "success": 1,
    "article": [ // 只有第一组数据的一个数组
        {
            "id": 282, // 文章id
            "courseId": 41, // 所属课程id
            "articleName": "近代中华民族的历史任务和辛亥革命", // 文章名
            "courseName": "第一课 近代革命史的起点", // 所属课程名
          	"content": "", // 文章内容
        }
    ]
}

/api/applicant/twenty-courses-score [GET]
20课成绩查询
参数列表:
token // 必选参数，无该参数跳转至登录页面
返回的json
{
  	"success": 1,
  	"studentInfo": [
        "id": 805874, 
        "student_id": "3013204098", // 学号
        "course_id": 43, // 课程id
   	    "score": 100, // 课程得分
        "complete_time": "2013-10-23 10:31:05", // 完成课程测试时间
        "course_name": "第三课 第一次国共合作和大革命的爆发", // 课程名
    ]
}

/api/applicant/{course_id}/exercise [GET]
20课考试
course_id // 课程id
token // 必选参数，无该参数跳转至登录页面
返回的json
{
  	"success": 1
  	"exercises": [ // 数组，返回20道题
        {
            "id": 3318, // 题目id
            "courseId": 42, // 所属课程id
            "courseName": "第二课 中国共产党的创立", // 所属课程
            "type": 0,
            "content": "<p>（），中国共产党派代表出席共产国际在莫斯科召开的远东各国共产党及民族革命团体第一次代表大会。</p>", // 题干
            "optionA": "1921年11月",
            "optionB": "1921年12月",
            "optionC": "1922年1月",
            "optionD": "1922年2月",
            "optionE": "" // A~E选项
        }
    ]
}

/api/applicant/{course_id}/exercise [POST]
20课考试，提交答案
参数列表
choose[] // 数组，按题号顺序存储用户提交的答案
token // 必选参数，无该参数跳转至登录页面
返回的json
	请求成功
	{
		"success": 1,
		"message": "答题成功",
		"score": 75 // 分数
	}	
  	请求失败
	{
	  	"message": "不好意思,你没有通过考试",
	  	"score": 45 // 请求失败也要让同学们自己得了多少分
	}
	
/api/applicant/sign [GET]
报名结业考试
参数列表
token // 必选参数，无该参数跳转至登录页面
返回的json
	请求成功
	{
		"success": 0
	}
	请求失败
	{
      	"message": "" // 提示信息
    }

/api/applicant/sign [POST]
报名结业考试，提交表单
参数列表
token // 必选参数，无该参数跳转至登录页面
campus // 校区
返回的json
	请求成功
	{
      	"success": 0
    }
	请求失败
	{
      	"message": "" // 提示信息
    }

/api/applicant/sign-result [GET]
报名结果
参数列表
token // 必选参数，无该参数跳转至登录页面
返回的json
	请求成功
	{
    	"success": 1,
    	"result": {
        	"id": 352384, // 报名信息id
        	"testId": 464,  // 考试id
        	"testName": "第五十三期入党申请人培训结业考试", // 考试期数
        	"sno": "3016218103",
        	"academyId": 16,
        	"academyName": "软件学院", 
       		"majorName": "",
        	"studentName": "",
        	"time": {
            	"date": "2017-11-30 02:55:11.000000", // 报名时间
            	"timezone_type": 3,
            	"timezone": "UTC"
        	},
        	"campus": ""
    	}
	}
	请求失败
	{
      	"message": ""
    }

/api/applicant/{entry_id}/sign-exit [GET]
退出报名
参数列表
entry_id // 报名信息id，即 /api/applicant/sign-result [GET] 返回json中的 result['id']
token // 必选参数，无该参数跳转至登录页面
返回的json
	请求成功
	{
    	"success": 1,
    	"message": "恭喜,您已经退出本期考试的报名,不能再参加本期考试了.!"
	}
	请求失败
	{
  		"message": ""
	}
	
/api/applicant/grade-check [GET]
成绩查询
参数列表
token // 必选参数，无该参数跳转至登录页面
返回的json
{
	"success": 1,
    "grade": [ // 数组，返回所有考试的信息
        {
            "id": 352384,
            "testId": 464,
            "testName": "第五十三期入党申请人培训结业考试",
            "sno": "3016218103",
            "academyId": 16,
            "academyName": "软件学院",
            "majorName": "",
            "studentName": "",
            "time": {
                "date": "2017-11-30 12:51:38.000000", // 考试时间
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "practiceGrade": 0, // 笔试成绩
            "articleGrade": 0, // 论文成绩
        }
    ],
    "count": 1 // 考试数目
}

/api/applicant/{entry_id}/certificate-check [GET]
证书查询
参数列表
entry_id // 报名信息id，即 /api/applicant/sign-result [GET] 返回json中的 result['id']
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success": 1,
    "cert": [ // 数组，返回所有的证书
        {
            "id": 1581,
            "sno": "3006202229",
            "studentName": "张笑平",
            "academyId": 2,
            "academyName": "精仪学院",
            "majorName": "",
            "entryId": 288057,
            "certNumber": "010668",
            "type": 1,
            "time": {
                "date": "-0001-11-30 00:00:00.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "getPerson": "曹兴", // 证书领取人
            "place": "院团委", // 证书存放处
            "practiceGrade": 60,
            "articleGrade": 77,
            "testGrade": ""
        }
    ]
}

/api/applicant/account-status [GET]
账号状态
参数列表
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success": 1,
    "basicInfo": { // 学生基础信息
        "user_number": "3016218113",
        "real_name": "",
      	"college": "软件学院",
        "major": "软件工程",
        "twt_name": "zk990202"
    },
    "studentInfo": [ // 数组，只有第一项
        {
            "id": 115823,
            "sno": "3016218103",
            "academyId": 16,
            "partyBranchId": 1220,
            "isPassed": 0, // 20课是否通过，通过为1，否则为0
            "isClear20": 0, // 20课是否被清楚，被清为1 
            "applicantIsLocked": 0, // 申请人结业培训是否被锁，被锁为1
        }
    ],
    "status": 0 // 申请人结业考试状态，通过为1
}
````