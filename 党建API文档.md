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
      	"basicInfo":
      	{
        	"user_number": "3016218103",
        	"real_name": "",
        	"college_code": "218",
        	"college": "软件学院",
        	"major": "软件工程",
        	"twt_name": "zk990202",
    	},
    	"result": {
        	"id": 352384, // 报名信息id
        	"testId": 464,  // 考试id
        	"testName": "第五十三期入党申请人培训结业考试", // 考试期数
        	"academyId": 16,
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
  	"basicInfo": {
        "user_number": "3016218103",
        "real_name": "",
        "college_code": "218",
        "college": "软件学院",
        "major": "软件工程",
        "twt_name": "zk990202",
    },
    "grade": [ // 数组，返回所有考试的信息
        {
            "id": 352384,
            "testId": 464,
            "testName": "第五十三期入党申请人培训结业考试",
            "academyId": 16,
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
  	"basicInfo": {
        "user_number": "3016218103",
        "real_name": "",
        "college_code": "218",
        "college": "软件学院",
        "major": "软件工程",
        "twt_name": "zk990202",
    },
    "cert":  
        {
            "id": 1581,
            "academyId": 2,
            "entryId": 288057,
            "certNumber": "010668", // 证书编号
            "type": 1,
            "time": {
                "date": "-0001-11-30 00:00:00.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "getPerson": "曹兴", // 证书发放人
            "place": "院团委", // 证书存放处
            "practiceGrade": 60,
            "articleGrade": 77,
            "testGrade": ""
        }
    
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
    "studentInfo": { 
         "id": 115823,
         "sno": "3016218103",
         "academyId": 16,
         "partyBranchId": 1220,
         "isPassed": 0, // 20课是否通过，通过为1，否则为0
         "isClear20": 0, // 20课是否被清楚，被清为1 
         "applicantIsLocked": 0, // 申请人结业培训是否被锁，被锁为1 
    },
    "status": 0 // 申请人结业考试状态，通过为1
}

所有请求成功都会返回success => 1，请求失败会返回报错信息message
````

## 2.院级积极分子培训

````json
/api/academy/course [GET]
院级积极分子培训首页/院级积极分子培训下的课程学习
参数列表
token // 必选参数，无该参数跳转至登录页面
返回的json
{
  	"success": 1,
	"notice": {
	    "current_page": 1 // 当前页
	  	"data":[ // 数组， 包含全部的返回的内容
	    	{
                "test_id": 599, // 培训id
                "test_parent": 584, // 所属总培训
                "test_name": "软件学院第十七期院级积极分子党校", // 培训名称
            }
	  	]
  		"last_page": 25, // 最后一页
        "next_page_url": "", // 下一页链接
        "per_page": 6, 
        "total": 150 // 总数据条数
    }
}

/api/academy/{test_id}/course-detail [GET]
课程详情
参数列表
test_id // 课程id，即/api/academy/course [GET] 回json中的notice['data'][i]['test_id']
返回的json
{
    "success": 1,
    "test": {
        "id": 599,
        "name": "软件学院第十七期院级积极分子党校", // 课程名称
        "parent": 584,
        "trainName": "第十七期积极分子培训",
        "academyId": "16",
        "academyName": "软件学院",
        "time": {
            "date": "2017-04-06 00:00:00.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "introduction": "", // 课程介绍
        "attention": "", // 课程要求
    }
}

/api/academy/sign [GET]
报名考试
参数列表
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success": 1,
    "test": {
        "test_id": 530,
        "test_parent": 517,
        "test_name": "软件学院第十四期院级积极分子党校",
        "test_of_academy": "16",
        "test_begintime": "2015-11-12 00:00:00",
        "test_introduction": "<p>", // 课程介绍
        "test_attention": "", // 课程要求
    }
}

/api/academy/sign [POST]
报名考试——提交
参数列表
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success": 1,
    "message": "恭喜您,报名成功!"
}

/api/academy/sign-detail [GET]
个人报名表/报名详情
参数列表
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success": 1,
  	"basicInfo": {
        "user_number": "3016218103",
        "real_name": "",
        "college_code": "218",
        "college": "软件学院",
        "major": "软件工程",
        "twt_name": "zk990202",
    },
    "signDetail": {
        "id": 135528,
        "testId": 530,
        "testName": "软件学院第十四期院级积极分子党校", 
        "time": {
            "date": "2017-12-10 16:04:44.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "status": 1, // 考试状态，0-5分别表示未录入、报名开始、报名截止、成绩录入、成绩录入结束、考试结束
        "isExit": 0 // 报名状态，0、1分别表示正常、已退选
    }
}

/api/academy/{entry_id}/sign-exit [GET]
退出报名
参数列表
entry_id // 报名信息id，即/api/academy/sign-detail [GET] 返回json中的id
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success": 1,
    "message": "恭喜,您已经退出本期考试的报名,不能再参加本期考试了.!"
}

/api/academy/grade-check [GET]
成绩查询
参数列表
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success": 1,
  	"basicInfo": {
        "user_number": "3016218103",
        "real_name": "",
        "college_code": "218",
        "college": "软件学院",
        "major": "软件工程",
        "twt_name": "zk990202",
    },
    "grade": {
        "id": 135528,
        "testId": 530,
        "testName": "软件学院第十四期院级积极分子党校",
        "academyId": 16,
        "time": {
            "date": "2017-12-13 20:26:30.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "practiceGrade": 0, // 实践成绩
        "articleGrade": 0, // 论文成绩
        "testGrade": 0, // 笔试成绩
        "isPassed": 0, // 考试状态，0-2分别表示不合格、合格、优秀
        "status": 1
    }
}

/api/academy/{test_id}/complain [GET]
申诉页面
参数列表
test_id // 培训id，即/api/academy/sign [GET] 中的test['test_id']
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success": 1,
    "basicInfo": {
        "user_number": "3016218103",
        "real_name": "张凯",
        "college_code": "218",
        "college": "软件学院",
        "major": "软件工程",
    },
    "test": {
        "id": 530,
        "name": "软件学院第十四期院级积极分子党校", // 申诉的培训
        "time": {
            "date": "2015-11-12 00:00:00.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        }
    }
}

/api/academy/{test_id}/complain [POST] 
申诉--提交
参数列表
test_id // 培训id，即/api/academy/sign [GET] 中的test['test_id']
token // 必选参数，无该参数跳转至登录页面
title // 申诉标题
content // 申诉内容
返回的json
{
    "success": 1,
    "message": "申诉成功!"
}

/api/academy/certificate-check [GET]
证书查询
参数列表
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success": 1,
    "basicInfo": {
        "user_number": "3016218103",
        "real_name": "",
        "college_code": "218",
        "college": "软件学院",
        "major": "软件工程",
    },
    "cert": {
        "id": 13623,
        "academyId": 6,
        "entryId": 21334,
        "certNumber": "20101196", // 证书编号
        "type": 2,
        "time": {
            "date": "-0001-11-30 00:00:00.000000", // 发放时间
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "getPerson": "刘丹青", // 发放人
        "place": "院团委", // 存放点
        "isLost": 0, // 证书状态，0、1分别表示正常、丢失
    }
}
````

## 3.预备党员培训

````json
/api/probationary/coures [GET]
预备党员培训首页/预备党员培训下的我的课表
参数列表
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success": 1,
  	"basicInfo": {
        "user_number": "3016218103",
        "real_name": "",
        "college_code": "218",
        "college": "软件学院",
        "major": "软件工程",
    },
    "entry": {
        "trainId": 446,
        "trainName": "第32期预备党员党校", // 培训期数
        "academyId": 3,
        "practiceGrade": 70, // 实践分数
        "articleGrade": 70, // 论文分数
        "time": {
            "date": "2014-09-15 20:52:20.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "isLastAdded": 0,
        "status": 1,
        "isAllPassed": 1,
        "isSystemAdd": 0,
        "certIsGrant": 1,
        "passCompulsory": 3, // 通过必修课数
        "passElective": 1, // 通过选修课数
        "exitCount": 0, // 退课次数
        "lastTrainId": 0,
        "isExit": 0,
        "countCheat": 0,
        "isDeleted": 0
    },
    "course": [ // 数组，返回所有已选课程
        {
            "id": 292144,
            "childId": 119295,
            "courseId": "205", // 课程id
            "courseName": "党章学习", // 课程名称
            "courseType": 0, // 1是必修，0是选修
            "entryTime": "0000-00-00 00:00:00", 
            "status": 1,
            "grade": 65,
            "isExit": 0 // 状态，1、0分别表示退选、正常
        }
    ]
}

/api/probationary/{entry_id}/course-exit [GET]
退课
参数列表
entry_id // 选课信息id，即/api/probationary/coures [GET] 返回json中的course[i]['id']
token // 必选参数，无该参数跳转至登录页面
返回的json
{
  	"success" : 1,
    "message": ""
}

/api/probationary/course-choose [GET]
选课
参数列表
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success": 1,
    "course": [ //数组，返回所有可选课程
        {
            "id": 1015, // 课程id
            "trainId": 446,
            "trainName": "第32期预备党员党校",
            "name": "党章学习", // 课程名
            "type": 0,
            "movieId": null,
            "movieName": "",
            "introduction": "",
            "requirement": "",
            "time": {
                "date": "2017-03-18 14:00:00.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "speaker": "张亚勇",
            "place": "卫津路校区大活一层报告厅",
            "limitNum": 400,
            "canInsert": 1,
            "isInserted": 1,
            "isDeleted": 0,
            "number": null
        }
    ]
}

/api/probationary/course-choose [POST]
选课--提交
参数列表
courseId[] // 数组，所有选择课程id
trainId  // 培训id
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success" : 1
}

/api/probationary/test-sign [GET]
考试报名
参数列表
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success": 1,
    "train": { // 该场考试信息
        "id": 446,
        "name": "第32期预备党员党校",
        "time": {
            "date": "2017-03-06 09:00:00.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "fileName": null,
        "filePath": null,
        "detail": "",
        "entryStatus": 1,
        "netChooseStatus": 1,
        "gradeSearchStatus": 1,
        "endListShow": 1,
        "goodMemberShow": 1,
        "endInsert": 1,
        "isEndInsert": 1,
        "isEnd": 1,
        "isDeleted": 0
    }
}

/api/probationary/test-sign-real [GET]
考试报名--真正提交上去
参数列表
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success": 1,
    "message": "恭喜你,报名成功! 现在就去选课吧!"
}

/api/probationary/sign-result [GET]
报名结果
参数列表
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success": 1,
  	"basicInfo": {
        "user_number": "3016218103",
        "real_name": "",
        "college_code": "218",
        "college": "软件学院",
        "major": "软件工程",
    },
    "entry": {
        "id": 157580,
        "trainId": 446,
        "trainName": "第32期预备党员党校",
        "academyId": 16,
        "practiceGrade": 0,
        "articleGrade": 0,
        "time": {
            "date": "2017-12-18 03:32:16.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "isLastAdded": 0,
        "status": 1,
        "isAllPassed": 0,
        "isSystemAdd": 0,
        "certIsGrant": 0,
        "passCompulsory": 0,
        "passElective": 0,
        "exitCount": 0,
        "lastTrainId": 0,
        "isExit": 0, // 我的报名状态
        "countCheat": 0,
        "isDeleted": 0
    }
}

/api/probationary/{entry_id}/sign-exit [GET]
退出报名
参数列表
entry_id // 报名信息id，即/api/probationary/sign-result [GET] 返回json中的entry['id']
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success": 1,
    "message": "恭喜,您已经退出本期考试的报名,不能再参加本期考试了.!"
}

/api/proationary/grade-check [GET]
成绩查询
参数列表
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success": 1,
  	"basicInfo": {
        "user_number": "3016218103",
        "real_name": "",
        "college_code": "218",
        "college": "软件学院",
        "major": "软件工程",
    },
    "grade": {
        "id": 119295,
        "trainId": 446,
        "trainName": "第32期预备党员党校",
        "academyId": 3,
        "practiceGrade": 70, // 实践成绩
        "articleGrade": 70, // 论文成绩
        "time": {
            "date": "2014-09-15 20:52:20.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "isLastAdded": 0,
        "status": 1,
        "isAllPassed": 1, // 结业状态
        "isSystemAdd": 0,
        "certIsGrant": 1,
        "passCompulsory": 3, // 必修课通过数
        "passElective": 1, // 选修课通过数
        "exitCount": 0,
        "lastTrainId": 0,
        "isExit": 0,
        "countCheat": 0, // 作弊次数
        "isDeleted": 0,
        "gradeSearchStatus": 1
    }
}

/api/probationary/{train_id}/complain [GET]
申诉--页面
参数列表
train_id // 即/api/proationary/grade-check [GET] 返回json中的grade['trainId']
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success": 1,
    "basicInfo": {
        "user_number": "3016218103",
        "real_name": "张凯",
        "college_code": "218",
        "college": "软件学院",
        "major": "软件工程",
        "twt_name": "zk990202"
    },
    "train": {
        "id": 446,
        "name": "第32期预备党员党校", // 考试期数
        "time": {
            "date": "2017-03-06 09:00:00.000000", // 考试时间
            "timezone_type": 3,
            "timezone": "UTC"
        }
    }
}

/api/probationary/{train_id}/complain [POST]
申诉--提交
参数列表
train_id // 即/api/proationary/grade-check [GET] 返回json中的grade['trainId']
title // 申诉标题
content // 申诉内容
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success": 1,
    "message": "申诉成功"
}

/api/probationary/certificate-check [GET]
证书查看
参数列表
token // 必选参数，无该参数跳转至登录页面
返回的json
{
    "success": 1,
    "basicInfo": {
        "user_number": "3016218103",
        "real_name": "",
        "college_code": "218",
        "college": "软件学院",
        "major": "软件工程",
    },
    "cert": {
        "id": 9468,
        "academyId": 1,
        "majorName": "",
        "entryId": 123113,
        "certNumber": "20091011", // 证书编号
        "type": 3,
        "time": {
            "date": "-0001-11-30 00:00:00.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "getPerson": "刘秋菊", // 发放人
        "place": "院团委", // 存放点
        "isLost": 0,
        "isDeleted": 0,
    }
}
````

