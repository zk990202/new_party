@extends('front.layouts.app')

@section('css')
@endsection

@section('main')

    <div class="total1">
        @include('front.layouts.personalSidebar')
        <div class="flow" scroll="no">
            <h2>个人状态</h2>
            <hr/>
            <div class="own1">
                <div class="{{ $data['status']['PartyApplication']['class']}}">
                    <a href="#">提交入党申请书</a>
                </div>
                <img src="/img3/ready.png">
            </div>
            <div class="own2">
                <img src="/img3/1.png" />
            </div>
            <div style="overflow: scroll;min-width: 850px"  viewport="1">
                <div class="own3">
                    <div class="{{ $data['status']['ApplicantPartySchool']['class']}}">
                        <div>
                            <a href="">网上申请人党校学习</a>
                        </div>
                        <img src="{{ $data['status']['ApplicantPartySchool']['pic']}}">
                    </div>
                    <img src="/img3/2.png" class="Own3img" />
                    <div class="{{ $data['status']['ApplicantFinalExam']['class']}}">
                        <div>
                            <a href="">结业考试</a>
                        </div>
                        <img src="{{ $data['status']['ApplicantFinalExam']['pic']}}">
                    </div>
                    <img src="/img3/2.png" class="Own3img"/>
                    <div class="{{ $data['status']['AcademyPartySchool']['class']}}">
                        <div>
                            <a href="">院级积极分子党校学习</a>
                        </div>
                        <img src="{{ $data['status']['AcademyPartySchool']['pic']}}">
                    </div>
                    <img src="/img3/8.png" class="Own3img" />
                </div>
                <div class="own3">
                    <div class="{{ $data['status']['IdeologicalReport_1']['class']}}">
                        <div>
                            <a href="">递交第一季度思想汇报</a>
                        </div>
                        <img src="{{ $data['status']['IdeologicalReport_1']['pic']}}">
                    </div>
                    <img src="/img3/2.png" class="Own3img"/>
                    <div class="{{ $data['status']['IdeologicalReport_2']['class']}}">
                        <div>
                            <a>递交第二季度思想汇报</a>
                        </div>
                        <img src="{{ $data['status']['IdeologicalReport_2']['pic']}}">
                    </div>
                    <img src="/img3/2.png" class="Own3img" />
                    <div class="{{ $data['status']['IdeologicalReport_3']['class']}}">
                        <div>
                            <a href="">递交第三季度思想汇报</a>
                        </div>
                        <img src="{{ $data['status']['IdeologicalReport_3']['pic']}}">
                    </div>
                    <img src="/img3/2.png" class="Own3img"/>
                    <div class="{{ $data['status']['IdeologicalReport_4']['class']}}">
                        <div>
                            <a href="">递交第四季度思想汇报</a>
                        </div>
                        <img src="{{ $data['status']['IdeologicalReport_4']['pic']}}">
                    </div>
                </div>
                <div class="own4">
                    <div class="{{ $data['status']['ApplicantLearningGroup']['class']}}">
                        <div>
                            <a href="">参加申请人学习小组</a>
                        </div>
                        <img src="{{ $data['status']['ApplicantLearningGroup']['pic']}}">
                    </div>
                    <img src="/img3/中字%20上.png"  class="Own4img"/>

                    <div class="{{ $data['status']['PartyActivist']['class']}}" style="margin-left: -40px">
                        <div>
                            <a href="">被确定为入党积极分子</a>
                        </div>
                        <img src="{{ $data['status']['PartyActivist']['pic']}}">
                    </div>
                    <img src="/img3/5.png" class="Own4img">
                    <div class="{{ $data['status']['CommunistPartyBranch']['class']}}" style="margin-top: -37px; margin-left: 10px">
                        <div>
                            <a href="">团支部推优</a>
                        </div>
                        <img src="{{ $data['status']['CommunistPartyBranch']['pic']}}">
                    </div>
                    <img src="/img3/5.png" class="Own4imgR"/>
                    <img src="/img3/中字%20下.png" class="Own4img"/>
                </div>
            </div>
            <div class="own5">
                <img src="/img3/7.png"/>
            </div>
            <div class="own6">
                <div>
                    <div class="finish">
                        <a href="">经支委会同意，准备近期发展，成为发展对象</a>
                    </div>
                    <img src="">
                </div>
                <img src="/img3/2.png" />
                <div>
                    <a href="">参加集中培训</a>
                </div>
                <img src="/img3/2.png" />
                <div>
                    <a href="">入党材料准备齐全</a>
                </div>
                <img src="/img3/2.png" />
                <div>
                    <a href="">支部向上级党组织汇报</a>
                </div>
                <img src="/img3/2.png" />
                <div>
                    <a href="">党员发展公示</a>
                </div>
                <img src="/img3/2.png" />
                <div>
                    <a href="">填写入党志愿书</a>
                </div>
                <img src="/img3/2.png" />
                <div>
                    <a href="">召开发展大会，党支部表决</a>
                </div>
                <img src="/img3/2.png" />
                <div>
                    <a href="">党委谈话，审批</a>
                </div>
                <img src="/img3/2.png" />
                <div>
                    <a href="">成为预备党员</a>
                </div>
            </div>
            <div class="own7">
                <img src="/img3/1.png">
            </div>

            <div class="own8">
                <img src="/img3/8.png" style="margin-top: -3px"/>
                <div>
                    <a href="">完成预备党员党校学习</a>
                </div>
                <img src="/img3/8.png"/>
            </div>
            <div class="own11">
                <div>
                    <a href="">递交第一季度个人小结</a>
                </div>
                <img src="/img3/2.png" class="Own11img"/>
                <div>
                    <a href="">递交第二季度个人小结</a>
                </div>
                <img src="/img3/2.png" class="Own11img"/>
                <div>
                    <a href="">递交第三季度个人小结</a>
                </div>
                <img src="/img3/2.png" class="Own11img"/>
                <div>
                    <a href="">递交第四季度个人小结</a>
                </div>
            </div>
            <div class="own10">
                <img src="/img3/8.png" style="margin-top: -3px"/>
                <div>
                    <a href="">按时参加党支部组织生活及党内活动</a>
                </div>
                <img src="/img3/8.png"/>
            </div>

            <div class="own9">
                <img  src="/img3/7.png"/>
            </div>
            <div class="own6">
                <div>
                    <a href="">递交转正申请</a>
                </div>
                <img src="/img3/2.png" />
                <div>
                    <a href="">党员转正公示</a>
                </div>
                <img src="/img3/2.png" />
                <div>
                    <a href="">党支部召开转正大会，表决通过</a>
                </div>
                <img src="/img3/2.png" />
                <div>
                    <a href="">党委审批</a>
                </div>
                <img src="/img3/2.png" />
                <div>
                    <a href="">成为中共正式党员</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/script/nav.js"></script>
@endsection