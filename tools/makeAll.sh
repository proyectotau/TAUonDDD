#!/bin/sh

# Entities
# php tools/makeEntity.php User id,name,surname,login
php tools/makeEntity.php Group id,name,desc
php tools/makeEntity.php Role id,name,desc
php tools/makeEntity.php Module id,name,desc

# User use-case
php tools/makeUseCaseEntity.php create User id,name,surname,login
php tools/makeUseCaseEntity.php read User id
php tools/makeUseCaseEntity.php update User id,name,surname,login
php tools/makeUseCaseEntity.php delete User id

# User Command
php tools/makeUseCaseEntityCommand.php create User id,name,surname,login
php tools/makeUseCaseEntityCommand.php read User id
php tools/makeUseCaseEntityCommand.php update User id,name,surname,login
php tools/makeUseCaseEntityCommand.php delete User id

# User Command handler
php tools/makeUseCaseEntityCommandHandler.php create User id,name,surname,login
php tools/makeUseCaseEntityCommandHandler.php read User id
php tools/makeUseCaseEntityCommandHandler.php update User id,name,surname,login
php tools/makeUseCaseEntityCommandHandler.php delete User id

# UserGroup relations
php tools/makeUseCaseXToY.php add User Group
php tools/makeUseCaseXToYCommand.php add User Group
php tools/makeUseCaseXToYCommandHandler.php add User Group

php tools/makeUseCaseXsFromY.php get User Group
php tools/makeUseCaseXsFromYCommand.php get User Group
php tools/makeUseCaseXsFromYCommandHandler.php get User Group

# GroupUser relations
php tools/makeUseCaseXToY.php add Group User
php tools/makeUseCaseXToYCommand.php add Group User
php tools/makeUseCaseXToYCommandHandler.php add Group User

php tools/makeUseCaseXsFromY.php get Group User
php tools/makeUseCaseXsFromYCommand.php get Group User
php tools/makeUseCaseXsFromYCommandHandler.php get Group User

# Group use-case
php tools/makeUseCaseEntity.php create Group id,name,desc
php tools/makeUseCaseEntity.php read Group id
php tools/makeUseCaseEntity.php update Group id,name,desc
php tools/makeUseCaseEntity.php delete Group id

# Group Command
php tools/makeUseCaseEntityCommand.php create Group id,name,desc
php tools/makeUseCaseEntityCommand.php read Group id
php tools/makeUseCaseEntityCommand.php update Group id,name,desc
php tools/makeUseCaseEntityCommand.php delete Group id

# Group Command handler
php tools/makeUseCaseEntityCommandHandler.php create Group id,name,desc
php tools/makeUseCaseEntityCommandHandler.php read Group id
php tools/makeUseCaseEntityCommandHandler.php update Group id,name,desc
php tools/makeUseCaseEntityCommandHandler.php delete Group id

# RoleGroup relations
php tools/makeUseCaseXToY.php add Role Group
php tools/makeUseCaseXToYCommand.php add Role Group
php tools/makeUseCaseXToYCommandHandler.php add Role Group

php tools/makeUseCaseXsFromY.php get Role Group
php tools/makeUseCaseXsFromYCommand.php get Role Group
php tools/makeUseCaseXsFromYCommandHandler.php get Role Group

# GroupRole relations
php tools/makeUseCaseXToY.php add Group Role
php tools/makeUseCaseXToYCommand.php add Group Role
php tools/makeUseCaseXToYCommandHandler.php add Group Role

php tools/makeUseCaseXsFromY.php get Group Role
php tools/makeUseCaseXsFromYCommand.php get Group Role
php tools/makeUseCaseXsFromYCommandHandler.php get Group Role

# Role use-case
php tools/makeUseCaseEntity.php create Role id,name,desc
php tools/makeUseCaseEntity.php read Role id
php tools/makeUseCaseEntity.php update Role id,name,desc
php tools/makeUseCaseEntity.php delete Role id

# Role Command
php tools/makeUseCaseEntityCommand.php create Role id,name,desc
php tools/makeUseCaseEntityCommand.php read Role id
php tools/makeUseCaseEntityCommand.php update Role id,name,desc
php tools/makeUseCaseEntityCommand.php delete Role id

# Role Command handler
php tools/makeUseCaseEntityCommandHandler.php create Role id,name,desc
php tools/makeUseCaseEntityCommandHandler.php read Role id
php tools/makeUseCaseEntityCommandHandler.php update Role id,name,desc
php tools/makeUseCaseEntityCommandHandler.php delete Role id

# Module use-case
php tools/makeUseCaseEntity.php create Module id,name,desc
php tools/makeUseCaseEntity.php read Module id
php tools/makeUseCaseEntity.php update Module id,name,desc
php tools/makeUseCaseEntity.php delete Module id

# Module Command
php tools/makeUseCaseEntityCommand.php create Module id,name,desc
php tools/makeUseCaseEntityCommand.php read Module id
php tools/makeUseCaseEntityCommand.php update Module id,name,desc
php tools/makeUseCaseEntityCommand.php delete Module id

# Module Command handler
php tools/makeUseCaseEntityCommandHandler.php create Module id,name,desc
php tools/makeUseCaseEntityCommandHandler.php read Module id
php tools/makeUseCaseEntityCommandHandler.php update Module id,name,desc
php tools/makeUseCaseEntityCommandHandler.php delete Module id

# RoleModule relations
php tools/makeUseCaseXToY.php add Role Module
php tools/makeUseCaseXToYCommand.php add Role Module
php tools/makeUseCaseXToYCommandHandler.php add Role Module

php tools/makeUseCaseXsFromY.php get Role Module
php tools/makeUseCaseXsFromYCommand.php get Role Module
php tools/makeUseCaseXsFromYCommandHandler.php get Role Module

# ModuleRole relations
php tools/makeUseCaseXToY.php add Module Role
php tools/makeUseCaseXToYCommand.php add Module Role
php tools/makeUseCaseXToYCommandHandler.php add Module Role

php tools/makeUseCaseXsFromY.php get Module Role
php tools/makeUseCaseXsFromYCommand.php get Module Role
php tools/makeUseCaseXsFromYCommandHandler.php get Module Role
