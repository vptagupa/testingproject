<?php
/**
* Author: Victor Tagupa Jr.
* Set App Configuration settings
*/
namespace App\Config;

Class Settings {
	use Attachment, Path, SystemInfo, ProposalProgram, SystemSettings;
}

trait  Attachment {

	public $allowed_extenstion = ['xls','csv','jpeg','jpg','png','txt','rar','zip','docx','pdf'];

	public $allowed_max_size = '5000000'; //in bytes  5000000

	public $not_allowed_filename_char = "*&%'^%$#@:?";

	public $has_security_code = false;

	public $security_code = 'ac3r';

	public $escape_extension = false;
}

trait Path {

	public $userPhotoPath = 'attachment/user-photo/';

	public $educationalPath = 'attachment/educational/';

	public $publicationPath = 'attachment/publication/';

	public $workXPpath = 'attachment/work_experience/';

	public $socialExtraPath = 'attachment/social_extracurricular/';

	public $scholarpath = 'attachment/scholars/';
	
	public $cv = 'attachment/cv/';

	public $format = 'attachment/format/';

	public $proposal_req = 'attachment/proposal-requirements/';

	public $nomination_req = 'attachment/nomination-requirements/';

	public $justification = 'attachment/justification/';

	public $personnelSGSInvitation = 'emails/sgs/invite/';
}

trait  SystemInfo {

	public static $title = 'CHED K to 12 Transition';

	public static $PartnerGroupID = 11;

	public static $InstitutionGroupID = 5;

	public static $ChedroGroupID = 12;

	public static $scholarGroupID = 7;

	public static $administratorID = 1;

	public static $PersonnelID = 4;

	public static $SHSGroupID = 13;

	public static $SGSID = 8;

	public static $TWGID = 9;

	public static $CEBID = 10;

	public static $FileExtensions = ['xls','csv','jpeg','jpg','png','txt','rar','docx','pdf'];
}

trait ProposalProgram {

	public static $FundedResearchID = 7;

	public static $OtherLibraryHoldings = 8;

	public static $OffsiteID = 2;

	public static $JointID = 3;

	public static $ConsortiumID = 4;

	public static $TechnicalDescMinLength = 10;

	public static $TechnicalDescMaxLength = 500;

	public static $OffSiteDescMinLength = 10;

	public static $OffSiteDescMaxLength = 500;

	public static $RationaleDescMinLength = 10;

	public static $RationaleDescMaxLength = 500;

	public static $EvaluationDescMinLength = 10;

	public static $EvaluationDescMaxLength = 500;

	public static $RequiredTemplateID = [1,2,3,4];

	public static $CVRequiredID = 2;

	public static $FileJustificationID = 13;
}

trait SystemSettings {
	public function system() {
		return new  \App\Modules\Setup\Models\SystemSettings;
	}
}
